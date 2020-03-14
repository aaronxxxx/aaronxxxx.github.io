<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @總代理&代理結算
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\common\controllers\JiesuanDoSumController as JiesuanDoSum;
use app\common\controllers\JiesuanDoController as JiesuanDo;

class JiesuanController extends Controller
{
    public function actionIndex($params = ''){
        if($params == 'TOP'){
            //取得所有總代理ID&名稱
            $sql = 'select * from agents_list where agent_level = 0';
            $JiesuanDoSum = new JiesuanDoSum();
        }else{
            //取得所有代理ID&名稱
            $sql = 'select * from agents_list where agent_level <> 0';
            $JiesuanDo = new JiesuanDo();
        }

        $db = Yii::$app->db;
        $agentsListArray = $db->createCommand($sql)->queryAll();

        //EX:$s_time = '2019-07-01 00:00:00';$e_time = '2019-07-31 23:59:59';first day of previous month => 同時用在跨年月
        $s_time = date("Y-m-d 00:00:00", strtotime("first day of previous month"));
        $e_time = date("Y-m-t 23:59:59", strtotime("first day of previous month"));

        foreach($agentsListArray as $key => $value){
            if($params == 'TOP') {
                $result = $JiesuanDoSum->actionAgentsJiesuan($value['id'], $s_time, $e_time);
                echo  '總代理:'.$value['agents_name'] . '  ' . $result  . PHP_EOL;
            }else{
                $result = $JiesuanDo->actionAgentsJiesuan($value,$s_time,$e_time);
                echo  '代理:'.$value['agents_name'] . '  ' . $result  . PHP_EOL;
            }
        }
    }
	
}