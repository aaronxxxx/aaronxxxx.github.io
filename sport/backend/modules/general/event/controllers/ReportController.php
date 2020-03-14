<?php
namespace app\modules\general\event\controllers;


use Yii;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventResult;
use app\modules\general\event\models\EventResultPk;
use app\modules\general\event\models\EventResultMultiple;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventTwopk;
use app\modules\general\event\models\EventMultiple;
use app\modules\general\event\models\EventMultipleOdds;
use app\modules\general\event\models\EventTwopkOdds;
use app\common\controllers\SportCheckoutController;

/**
 * odds controller for the event module
 */
class ReportController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除
    }

    public function actionIndex()
    {
        $oid = $this->getParam('oid', '');

        if ( empty($oid) ) {
            echo "
                <script>
                    $(function() {
                        location.href='/#/event/result/index';
                    })
                </script>";
            exit;
        }

        // 搜尋賽事資訊
        $eventOfficial = EventOfficial::find()
            ->where(['id' => $oid])
            ->asArray()
            ->one();

        if ( empty($eventOfficial) ) {
            echo "
                <script>
                    $(function() {
                        alert('查无资讯');
                        location.href='/#/event/result/index';
                    })
                </script>";
            exit;
        }

        //取得賽事內PK參與者
        $pk = EventTwopk::find()
            ->where(['official_id' => $eventOfficial['id']])
            ->asArray()
            ->all();

        $idArray = [];

        foreach ($pk as $key => $val) {
            if (! in_array($val['player1'], $idArray) ) {
                $idArray[] = $val['player1'];
            }

            if (! in_array($val['player2'], $idArray) ) {
                $idArray[] = $val['player2'];
            }
        }

        $player = EventPlayer::find()
            ->where(['id' => $idArray])
            ->asArray()
            ->all();

        //取得賽事內多項目上下層級
        $multi = EventMultiple::find()
            ->where(['official_id' => $eventOfficial['id']])
            ->asArray()
            ->all();

        foreach ($multi as $key => $val) {
            $multi[$key]['items'] = EventMultipleOdds::find()
                ->where([ 'official_id' => $eventOfficial['id'], 'multiple_id' => $val['id'] ])
                ->asArray()
                ->all();
        }

        $chartData = [];
        //確認是否送單，已送單則讀取測試資訊
        $getData = Yii::$app->request->get();
        // if ( !empty($postData['oid'] ) ) {

        // }

        return $this->render('index', [
            'oid' => $oid,
            'data' => $eventOfficial,
            'multiple' => $multi,
            'player' => $player
        ]);
    }

    public function actionCheckoutResult()
    {
        $getData = Yii::$app->request->post();

        $playerScore = []; //寫入資料庫用各隊分數array
        $multiItem = [];  //寫入資料庫用多項目array

        foreach ($getData as $key => $val) {
            $temp = explode('-', $key);

            if (! empty($temp[1]) ) {
                if ($temp[1] == 'player_score') {
                    $playerScore[$temp[0]] = $val;
                } elseif ($temp[1] == 'multiple') {
                    $multiItem[$temp[0]] = $val;
                }
            }
        }

        $pkResult = [];
        //取得比賽項目，注入資訊
        $pkTemp = EventTwopk::find()
            ->where(['official_id' => $getData['oid']])
            ->asArray()
            ->all();

        $multiTemp = EventMultiple::find()
            ->where(['official_id' => $getData['oid']])
            ->asArray()
            ->all();

        $eventMultipleOdds = EventMultipleOdds::find()
            ->where(['official_id' => $getData['oid']])
            ->asArray()
            ->all();

        foreach ($eventMultipleOdds as $key => $val) {
            $multipleOdds[$val['id']] = $val['title'];
        }

		foreach ($pkTemp as $key => $val) {
			//補入相關分數
			$scoreTemp = array();
			$scoreTemp[ $val['player1'] ] = $playerScore[ $val['player1'] ];
			$scoreTemp[ $val['player2'] ] = $playerScore[ $val['player2'] ];
			$pkResult[ $val['id'] ] = $scoreTemp;
		}

        $check = ['official_id' => $getData['oid'], 'pk' => $pkResult, 'multi' => $multiItem];

        $chartData = SportCheckoutController::actionLotteryCheckout('', '0', 'Y', $check);
        /*
        報表用資訊
		$simulationReturn['sum_bet_money'] = 總投注額
		$simulationReturn['sum_win'] = 總贏金額
		$simulationReturn['result'][ type(1=PK, 2=multi) ][ issue_id ][ [ bet, win ] ]
        */
        $returnData = [];
        $pkCompare = [];
        $multiCompare = [];
        $orderCompare = [];
        $amountCompare = [];
        $playerArray = [];

        $eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();

        foreach ($eventPlayer as $key => $val) {
            $playerArray[$val['id']] = $val['title'];
        }

        //1.產出PK項目投注
        foreach ($pkTemp as $key => $val) {
            $thisTitle = $playerArray[ $val['player1'] ] . ' VS ' . $playerArray[ $val['player2'] ];

            $pkCompare[$key] = [
                'y' => $thisTitle ,
                'item1' => isset($chartData['result'][1][ $val['id'] ]['bet']) ? $chartData['result'][1][ $val['id'] ]['bet'] : 0,
                'item2' => isset($chartData['result'][1][ $val['id'] ]['win']) ? $chartData['result'][1][ $val['id'] ]['win'] : 0
            ];

            if (isset($chartData['result'][1][ $val['id'] ])) {
                $orderCompare[] = ['label' => 'PK比:' . $thisTitle, 'value' => $chartData['result'][1][ $val['id'] ]['count']];
                $amountCompare[] = ['label' => 'PK比:' . $thisTitle, 'value' => $chartData['result'][1][ $val['id'] ]['bet']];
            }
        }

        //1.產出multi項目投注
        foreach ($multiTemp as $key => $val) {
            $multiCompare[$key] = [
                'y' => $val['title'],
                'item1' => isset($chartData['result'][2][ $val['id'] ]['bet']) ? $chartData['result'][2][ $val['id'] ]['bet'] : 0,
                'item2' => isset($chartData['result'][2][ $val['id'] ]['win']) ? $chartData['result'][2][ $val['id'] ]['win'] : 0
            ];

            if (isset($chartData['result'][2][ $val['id'] ])) {
                $orderCompare[] = ['label' => '多項目:' . $val['title'], 'value' => $chartData['result'][2][ $val['id'] ]['count']];
                $amountCompare[] = ['label' => '多項目:' . $val['title'], 'value' => $chartData['result'][2][ $val['id'] ]['bet']];
            }
        }

        $returnData['pkCompare'] = $pkCompare;
        $returnData['multiCompare'] = $multiCompare;
        $returnData['orderCompare'] = $orderCompare;
        $returnData['amountCompare'] = $amountCompare;
        $returnData['bet_total'] = $chartData['bet_total'];
        $returnData['win_total'] = $chartData['win'];
        $returnData['profit'] = $chartData['bet_total'] - $chartData['win'];
        $returnData['profit_rate'] = round(($chartData['bet_total'] - $chartData['win']) / $chartData['bet_total'], 4);

        if ($returnData['profit'] < 0) {
            $returnData['profit'] = '<span style="color:red;">' . $returnData['profit'] . '</span>';
        }

        if ($returnData['profit_rate'] < 0) {
            $returnData['profit_rate'] = '<span style="color:red;">' . ($returnData['profit_rate'] * 100) . ' %</span>';
        } else {
            $returnData['profit_rate'] = ($returnData['profit_rate'] * 100) . ' %';
        }

        // 各賽事細項表格
        // 兩方
        foreach ($chartData['detail'][1] as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $betTotal = $chartData['result'][1][$key]['bet'];
                $profit = $val1['bet_money'] - $val1['win'];
                $profitRate = round(($betTotal - $val1['win']) / $betTotal * 100, 2);

                $chartData['detail'][1][$key][$key1]['profit'] = $profit >= 0 ? $profit : '<span style="color:red;">' . $profit . '</span>';
                $chartData['detail'][1][$key][$key1]['profitRate'] = $profitRate >= 0 ? $profitRate : '<span style="color:red;">' . $profitRate . '</span>';
                $chartData['detail'][1][$key][$key1]['player'] = $playerArray[$key1];

                $detail['twopk'][$key][] = $chartData['detail'][1][$key][$key1];
            }
        }

        // 多項目
        foreach ($chartData['detail'][2] as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $betTotal = $chartData['result'][2][$key]['bet'];
                $profit = $val1['bet_money'] - $val1['win'];
                $profitRate = round(($betTotal - $val1['win']) / $betTotal * 100, 2);

                $chartData['detail'][2][$key][$key1]['profit'] = $profit >= 0 ? $profit : '<span style="color:red;">' . $profit . '</span>';
                $chartData['detail'][2][$key][$key1]['profitRate'] = $profitRate >= 0 ? $profitRate : '<span style="color:red;">' . $profitRate . '</span>';
                $chartData['detail'][2][$key][$key1]['item'] = $multipleOdds[$key1];

                $detail['multi'][$key][] = $chartData['detail'][2][$key][$key1];
            }
        }

        $returnData['detail'] = $detail;
        // 各賽事細項表格結束

        return json_encode($returnData);
    }

    /**
     * event注单结算
     */
    public function actionDoState()
    {
        $code = array('结算成功','重算成功','部分结算成功','部分重算成功','结算失败','重算失败','无效的参数','期数修改失败','注单不存在');
        $code[-1]='结算接口连接失败';

        $jsType = $this->getParam('jsType', 0);
        $official_id = $this->getParam('official_id', '');

        $result = SportCheckoutController::actionLotteryCheckout($official_id, $jsType, 'N');

        if (isset($result)) {
            if ($result['fail'] > 0) {
                echo '結算結果 - '.PHP_EOL.' 成功：'.round($result['success']).' 筆, 失敗：'.round($result['fail']).' 筆';
                exit;
            } else {
                if ($jsType == '1') {
                    return $code[1];
                }

                return $code[0];
            }
        } else {
            return '结算有误，请稍后再试';
        }
    }
}
