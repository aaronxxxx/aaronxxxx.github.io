<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\common\controllers\EventJiesuanDoSumController as JiesuanDoSum;
use app\common\controllers\EventJiesuanDoController as JiesuanDo;

class EventJiesuanController extends Controller
{
    public function actionIndex()
    {
        // 取得所有代理类型為流水分成的總代理&代理
        $sql = 'SELECT * FROM agents_list WHERE agents_type = "流水分成" ORDER BY agent_level';
        $db = Yii::$app->db;
        $agentsListArray = $db->createCommand($sql)->queryAll();

        $JiesuanDoSum = new JiesuanDoSum();
        $JiesuanDo = new JiesuanDo();

        // 結算前一天的帳
        $s_time = date("Y-m-d 00:00:00", strtotime("-1 Day"));
        $e_time = date("Y-m-d 23:59:59", strtotime("-1 Day"));

        foreach ($agentsListArray as $key => $value) {
            if ($value['agent_level'] == 0) {
                $result = $JiesuanDoSum->actionAgentsJiesuan($value, $s_time, $e_time);
                echo  '總代理: ' . $value['agents_name'] . '  ' . $result  . PHP_EOL;
            } else {
                $result = $JiesuanDo->actionAgentsJiesuan($value, $s_time, $e_time);
                echo  '代理: ' . $value['agents_name'] . '  ' . $result  . PHP_EOL;
            }
        }
    }

}