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
    public $eventPlayer = [];

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();
    }

    public function actionIndex()
    {
        $oid = $this->getParam('oid', '');

        if( empty($oid) ){
            echo "
            <script>
                $(function(){
                    location.href='/#/event/result/index';
                })
            </script>";
            exit;
        }
        
        //根據標題 搜尋賽事資訊
        $eventOfficial = EventOfficial::find()
            ->where(['id' => $oid])
            ->asArray()
            ->one();

        if( empty($eventOfficial) ){
            echo "
            <script>
                $(function(){
                    alert('查无资讯');
                    location.href='/#/event/result/index';
                })
            </script>";
            exit;
        }


        //取得賽事內PK參與者
        $pk = EventTwopk::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();
        $idArray = array();

        foreach( $pk as $key => $val ){
            if( !in_array( $val['player1'], $idArray ) ) {
                $idArray[] = $val['player1'];
            }
            if( !in_array( $val['player2'], $idArray ) ) {
                $idArray[] = $val['player2'];
            }
        }
        $player = EventPlayer::find()->where(['id' => $idArray ])->asArray()->all();

        //取得賽事內多項目上下層級
        $multi = EventMultiple::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();

        foreach( $multi as $key => $val ){
            $multi[$key]['items'] = EventMultipleOdds::find()->where(['official_id' => $eventOfficial['id'], 'multiple_id' => $val['id'] ])->asArray()->all();

        }

        $chartData = array();
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

    public function actionCheckoutResult (){

        $getData = Yii::$app->request->post();

        $playerScore = array(); //寫入資料庫用各隊分數array
        $multiItem = array();  //寫入資料庫用多項目array

        foreach( $getData as $key => $val ) {
            $temp = explode('-',$key);
            if ( !empty($temp[1]) ) {
                if( $temp[1] == 'player_score' ){
                    $playerScore [$temp[0]] = $val;
                } else if ( $temp[1] == 'multiple' ) {
                    $multiItem [$temp[0]] = $val;
                }
            }
        }

        $pkResult = array();
        //取得比賽項目，注入資訊
        $pkTemp = EventTwopk::find()->where(['official_id'=>$getData['oid']])->asArray()->all();
        $multiTemp = EventMultiple::find()->where(['official_id'=>$getData['oid']])->asArray()->all();
		foreach( $pkTemp as $key => $val ){
			//補入相關分數
			$scoreTemp = array();
			$scoreTemp[ $val['player1'] ] = $playerScore[ $val['player1'] ];
			$scoreTemp[ $val['player2'] ] = $playerScore[ $val['player2'] ];
			$pkResult[ $val['id'] ] = $scoreTemp;
		}

        $check = array('official_id'=> $getData['oid'], 'pk' => $pkResult, 'multi' => $multiItem);

        $chartData = SportCheckoutController::actionLotteryCheckout('','0','Y', $check);
        /*
        報表用資訊
		$simulationReturn['sum_bet_money'] = 總投注額
		$simulationReturn['sum_win'] = 總贏金額
		$simulationReturn['result'][ type(1=PK, 2=multi) ][ issue_id ][ [ bet, win ] ]
        */
        // print_r($pkTemp);exit;
        $returnData = array();
        $pkCompare = array();
        $multiCompare = array();
        $orderCompare = array();
        $amountCompare = array();

        $playerArray = array();
        $temp = EventPlayer::find()->asArray()->all();
        foreach( $temp as $key => $val  ){
            $playerArray[$val['id']] = $val['title'];
        }

        //1.產出PK項目投注
        foreach($pkTemp as $key => $val){

            $thisTitle = $playerArray[ $val['player1'] ] .' VS ' .$playerArray[ $val['player2'] ];

            $pkCompare[$key] = [
                'y'=> $thisTitle , 
                'item1'=> isset($chartData['result'][1][ $val['id'] ]['bet']) ? $chartData['result'][1][ $val['id'] ]['bet'] : 0, 
                'item2'=> isset($chartData['result'][1][ $val['id'] ]['win']) ? $chartData['result'][1][ $val['id'] ]['win'] : 0
            ];
            if( isset($chartData['result'][1][ $val['id'] ])) {
                $orderCompare[] = ['label'=>'PK比:'.$thisTitle, 'value'=>$chartData['result'][1][ $val['id'] ]['count']];
                $amountCompare[] = ['label'=>'PK比:'.$thisTitle, 'value'=>$chartData['result'][1][ $val['id'] ]['bet']];
            }
        }

        //1.產出multi項目投注
        foreach($multiTemp as $key => $val){

            $multiCompare[$key] = [
                'y'=> $val['title'], 
                'item1'=> isset($chartData['result'][2][ $val['id'] ]['bet']) ? $chartData['result'][2][ $val['id'] ]['bet'] : 0, 
                'item2'=> isset($chartData['result'][2][ $val['id'] ]['win']) ? $chartData['result'][2][ $val['id'] ]['win'] : 0
            ];
            if( isset($chartData['result'][2][ $val['id'] ])) {
                $orderCompare[] = ['label'=>'多項目:'.$val['title'], 'value'=>$chartData['result'][2][ $val['id'] ]['count']];
                $amountCompare[] = ['label'=>'多項目:'.$val['title'], 'value'=>$chartData['result'][2][ $val['id'] ]['bet']];
            }
        }

        $returnData['pkCompare'] = $pkCompare;
        $returnData['multiCompare'] = $multiCompare;
        $returnData['orderCompare'] = $orderCompare;
        $returnData['amountCompare'] = $amountCompare;
        $returnData['bet_total'] = $chartData['bet_total'];
        $returnData['win_total'] = $chartData['win'];
        $returnData['profit'] = $chartData['bet_total'] - $chartData['win'];
        $returnData['profit_rate'] = ( $chartData['bet_total'] - $chartData['win'] ) / $chartData['bet_total'];

        if( $returnData['profit'] < 0 ){
            $returnData['profit'] = '<span style="color:red;">'.$returnData['profit'].'</span>';
        }
        if( $returnData['profit_rate'] < 0 ){
            $returnData['profit_rate'] = '<span style="color:red;">'.($returnData['profit_rate']*100).' %</span>';
        } else {
            $returnData['profit_rate'] = ($returnData['profit_rate']*100).' %';
        }

        return json_encode($returnData);

    }

}
