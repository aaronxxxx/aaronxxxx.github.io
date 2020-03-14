<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\general\commands;

use Yii;
use yii\console\Controller;
use app\modules\event\models\EventOfficial;
use app\modules\event\models\EventPlayer;
use app\modules\event\models\EventTwopk;
use app\modules\event\models\EventMultiple;
use app\modules\event\models\EventMultipleOdds;
error_reporting(0);
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LotteryController extends Controller
{
    public function actionIndex()
    {
        $cqssc = \app\modules\lottery\modules\lzcqssc\controllers\IndexController::getCqsscInfo();
        $cqsfc = \app\modules\lottery\modules\lzcqsf\controllers\IndexController::getCqsfcInfo();
        $fc3d = \app\modules\lottery\modules\lzfc3d\controllers\IndexController::getFc3dInfo();
        $gd11 = \app\modules\lottery\modules\lzgd11\controllers\IndexController::getGd11x5Info();
        $gdsfc = \app\modules\lottery\modules\lzgdsf\controllers\IndexController::getGdsfInfo();
        $gxsf = \app\modules\lottery\modules\lzgxsf\controllers\IndexController::getGxsfInfo();
        $kl8 = \app\modules\lottery\modules\lzkl8\controllers\IndexController::getBjkl8Info();
        $pk10 = \app\modules\lottery\modules\lzpk10\controllers\IndexController::getBjpk10Info();
        $pl3 = \app\modules\lottery\modules\lzpl3\controllers\IndexController::getPl3Info();
        $shssl = \app\modules\lottery\modules\lzshssl\controllers\IndexController::getShsslInfo();
        $tjsf = \app\modules\lottery\modules\lztjsf\controllers\IndexController::getTjsfcInfo();
        $tjssc = \app\modules\lottery\modules\lztjssc\controllers\IndexController::getTjsscInfo();
        $ssrc = \app\modules\lottery\modules\lzssrc\controllers\IndexController::getSsrcInfo(); //新增極速賽車
        $mlaft = \app\modules\lottery\modules\lzmlaft\controllers\IndexController::getMlaftInfo(); //新增幸运飞艇
        $ts5 = \app\modules\lottery\modules\lzts5\controllers\IndexController::getTs5Info(); // 新增腾讯分分彩
        $orpk = \app\modules\lottery\modules\lzorpk\controllers\IndexController::getorpkInfo(); //新增老pk拾
        $lotterInfo = [
            'cqssc' => $cqssc,
            'cqsfc' => $cqsfc,
            'fc3d' => $fc3d,
            'gd11' => $gd11,
            'gdsfc' => $gdsfc,
            'gxsf' => $gxsf,
            'kl8' => $kl8,
            'pk10' => $pk10,
            'pl3' => $pl3,
            'shssl' => $shssl,
            'tjsf' => $tjsf,
            'tjssc' => $tjssc,
            'ssrc' => $ssrc,
            'mlaft' => $mlaft,
            'ts5' => $ts5,
            'orpk' => $orpk,
        ];
        $file = Yii::$app->getBasePath()."/web/file/lottery.json";
        file_put_contents($file, json_encode($lotterInfo));
        echo $file;
        self::ssrc_result();
        self::tj_result();
        self::spsix_result();
        // self::eventResult();
    }

    public function ssrc_result()
    {
        $ssrc = \app\modules\lottery\controllers\LotteryResultApiController::GetLotteryJsonResults('lottery_result_ssrc', '10'); //新增極速賽車
        $result_array = array();

        foreach ($ssrc as $key => $value) {
            $result_array[$key]['expect'] = $ssrc[$key]['qishu'];
            $result_array[$key]['opencode'] = [
                $ssrc[$key]['ball_1'],
                $ssrc[$key]['ball_2'],
                $ssrc[$key]['ball_3'],
                $ssrc[$key]['ball_4'],
                $ssrc[$key]['ball_5'],
                $ssrc[$key]['ball_6'],
                $ssrc[$key]['ball_7'],
                $ssrc[$key]['ball_8'],
                $ssrc[$key]['ball_9'],
                $ssrc[$key]['ball_10'],
            ];
            $result_array[$key]['opentime'] = $ssrc[$key]['datetime'];
        }

        $file = Yii::$app->getBasePath() . "/web/file/Results/ssrc.json";
        file_put_contents($file, json_encode($result_array));
    }

    public function tj_result()
    {
        $tj = \app\modules\lottery\controllers\LotteryResultApiController::GetLotteryJsonResults('lottery_result_tj','10'); //新增時時彩
        $result_array=array();
        foreach ($tj as $key => $value) {
            $result_array[$key]['expect'] = $value['qishu'];
            $result_array[$key]['opencode'] = [
                $value['ball_1'],
                $value['ball_2'],
                $value['ball_3'],
                $value['ball_4'],
                $value['ball_5'],
            ];
            $result_array[$key]['opentime'] = $value['datetime'];
        }
        $file = Yii::$app->getBasePath()."/web/file/Results/tj.json";
        file_put_contents($file, json_encode($result_array));
    }

    public function spsix_result()
    {
        $spsix = \app\modules\lottery\controllers\LotteryResultApiController::GetLotteryJsonResults('lottery_result_splhc','10'); //新增急速六合彩
        $result_array=array();
        foreach ($spsix as $key => $value) {
            $result_array[$key]['expect'] = $value['qishu'];
            $result_array[$key]['opencode'] = [
                $value['ball_1'],
                $value['ball_2'],
                $value['ball_3'],
                $value['ball_4'],
                $value['ball_5'],
                $value['ball_6'],
                $value['ball_7'],
            ];
            $result_array[$key]['opentime'] = $value['datetime'];
        }
        $file = Yii::$app->getBasePath()."/web/file/Results/spsix.json";
        file_put_contents($file, json_encode($result_array));
    }

    public function eventResult()
    {
        $newJson = [];

        // 賽事控制
        $eventOfficial = EventOfficial::find()
            ->where(['status' => 1])
            ->andWhere(['<=', 'kaipan_time', date("Y-m-d H:i:s")])
            ->andWhere(['>=', 'fenpan_time', date("Y-m-d H:i:s")])
            ->orderBy(['kaipan_time' => SORT_DESC])
            ->asArray()
            ->all();

        if ($eventOfficial) {
            // 塞資料到json所需的格式
            foreach ($eventOfficial as $key => $val) {
                $Official = [];
                $pk = [];
                $multi = [];

                $Official['fenpan_time'] = [
                    0 => date("Y-m-d", strtotime($val['fenpan_time'])),
                    1 => date("H:i:s", strtotime($val['fenpan_time']))
                ];
                $Official['kaijiang_time'] = [
                    0 => date("Y-m-d", strtotime($val['kaijiang_time'])),
                    1 => date("H:i:s", strtotime($val['kaijiang_time']))
                ];

                $eventTwopk = EventTwopk::getAllByOfficial($val['id']);

                foreach ($eventTwopk as $key1 => $val1) {
                    $pk[$key1]['rangfen'] = $val1['player1_handicap'] ? $val1['player1_handicap'] : $val1['player2_handicap'];

                    //判定 客主方資料索引為何
                    if ( empty($val1['player1_handicap']) ) {
                        $player1 = 'customer';
                        $player2 = 'home';
                    } else {
                        $player1 = 'home';
                        $player2 = 'customer';
                    }

                    $pk[$key1]['no'] = $val1['qishu'];
                    $pk[$key1][ $player1 ]['id'] = $val1['player1'];
                    $pk[$key1][ $player1 ]['status'] = $val1['player1_status'];
                    $pk[$key1][ $player1 ]['name'] = $val1['p1_title'];
                    $pk[$key1][ $player1 ]['description'] = $val1['p1_summary'];
                    $pk[$key1][ $player1 ]['imgUrl'] = '/timthumb.php?w=250&h=250&src='.$val1['p1_img_url'];
                    $pk[$key1][ $player1 ]['rate'] = $val1['player1_odds'];
                    $pk[$key1][ $player1 ]['url'] = [
                        0 => $val1['p1_link1'],
                        1 => $val1['p1_link2'],
                        2 => $val1['p1_link3']
                    ];
                    $pk[$key1][ $player2 ]['id'] = $val1['player2'];
                    $pk[$key1][ $player2 ]['status'] = $val1['player2_status'];
                    $pk[$key1][ $player2 ]['name'] = $val1['p2_title'];
                    $pk[$key1][ $player2 ]['description'] = $val1['p2_summary'];
                    $pk[$key1][ $player2 ]['imgUrl'] = '/timthumb.php?w=250&h=250&src='.$val1['p2_img_url'];
                    $pk[$key1][ $player2 ]['rate'] = $val1['player2_odds'];
                    $pk[$key1][ $player2 ]['url'] = [
                        0 => $val1['p2_link1'],
                        1 => $val1['p2_link2'],
                        2 => $val1['p2_link3']
                    ];

                }

                //待優化
                $eventMultiple = EventMultiple::getAllByOfficial($val['id']);

                foreach ($eventMultiple as $key1 => $val1) {
                    $multi[$key1]['no'] = $val1['qishu'];
                    $multi[$key1]['banner'] = !empty($val1['img_url']) ? '/timthumb.php?w=1080&h=140&src='.$val1['img_url'] : '/themes/saiban/assets/images/sport/tittle_bg.png';
                    $multi[$key1]['title'] = $val1['title'];

                    $eventMultipleOdds = EventMultipleOdds::find()
                        ->where(['multiple_id' => $val1['id']])
                        ->asArray()
                        ->all();

                    foreach ($eventMultipleOdds as $key2 => $val2) {
                        $multi[$key1]['item'][] = [
                            0 => $val2['id'],
                            1 => $val2['status'],
                            2 => $val2['title'],
                            3 => $val2['odds']
                        ];
                    }
                }

                $newJson[$val['qishu']]['Official'] = $Official;
                $newJson[$val['qishu']]['pk'] = $pk;
                $newJson[$val['qishu']]['multi'] = $multi;
            }
        }

        //塞完了，寫進json檔案
        $filePath = Yii::$app->getBasePath() . "/web/themes/saiban/assets/yuntsai/files";

        if (! is_readable($filePath)) {
            mkdir($filePath, 0700, true);
        }

        $file = $filePath . "/new.json";
        file_put_contents($file, json_encode($newJson));
    }
}
