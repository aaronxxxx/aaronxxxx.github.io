<?php
/*
 * @Description: 彩票自開獎
 * @Author: Jonhy
 * @Date: 2018-12-14 10:50:25
 * @LastEditTime: 2019-05-22 15:57:20
 * @LastEditors: Please set LastEditors
 * @Last-Edit : 改成可多個彩票使用
function getQishu()要各個彩種調整
 */
namespace app\commands;

use app\common\controllers\LotteryCheckoutController as SpCheckout;
use Yii;
use yii\console\Controller;

class SpsscAwardBuildController extends Controller
{
    public function actionIndex()
    {
        /* $lotteryConfig
        name - 彩票名稱,
        startNumber - 開獎最大號碼,
        endNumber - 開獎最小號碼,
        lottery_frequency - 開獎頻率(秒),
        table - 開獎儲存的表格
         */
        $lotteryConfig =
            [
            'TJ' => [
                'name' => '极速时时彩',
                'startNumber' => 0,
                'endNumber' => 9,
                'awardBalls' => 5,
                'lottery_frequency' => 108,
                'table' => 'lottery_result_tj',
                'build_type' => 2, //開獎產生方式
            ],
            'SSRC' => [
                'name' => '极速赛车',
                'startNumber' => 1,
                'endNumber' => 10,
                'awardBalls' => 10,
                'lottery_frequency' => 90,
                'table' => 'lottery_result_ssrc',
                'build_type' => 1, //開獎產生方式
            ],
            'ORPK' => [
                'name' => '老PK拾',
                'startNumber' => 1,
                'endNumber' => 10,
                'awardBalls' => 10,
                'lottery_frequency' => 300,
                'table' => 'lottery_result_orpk',
                'build_type' => 1, //開獎產生方式
            ],
        ];

        // 急速系列反映速度問題，改為中斷25秒在執行一次
        foreach ($lotteryConfig as $key1 => $value1) {
            $result = $this->awardBuild($key1, $value1);
        }

        sleep(25);

        foreach ($lotteryConfig as $key1 => $value1) {
            $result = $this->awardBuild($key1, $value1);
        }
        //print_r($result);
    }

    #取得開獎球號
    #snumber 指定開獎方式
    public function getBall($startNumber, $endNumber, $snumber = '')
    {
        //if(count($ratioNumber) > 0){
        if ($snumber != '') {
            $pool = [];
            $middle_num = $startNumber + (($endNumber - $startNumber) / 2);
            switch ($snumber) {
                case '大':
                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                        if ($i >= $middle_num) {
                            $pool[] = $i;
                        }
                    }
                    break;
                case '小':
                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                        if ($i < $middle_num) {
                            $pool[] = $i;
                        }
                    }
                    break;
                case '单':
                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                        if ($i % 2 != 0) {
                            $pool[] = $i;
                        }
                    }
                    break;
                case '双':
                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                        if ($i % 2 == 0) {
                            $pool[] = $i;
                        }
                    }
                    break;
                default:
                    return $snumber;
                    break;
            }
            $randKey = array_rand($pool);
            return $pool[$randKey];
        } else {
            return rand($startNumber, $endNumber);
        }
    }
    /**
     * @description: 用時間找出上一期的期數
     * @param {$dateTime:時間,$lottery_frequency:開獎頻率,$type:彩種}
     * @return: qishu:期數
     */
    public function getQishu($dateTime, $lottery_frequency, $type, $name)
    {
        switch ($type) {
            case 'TJ':
                $hour = date('H', strtotime($dateTime));
                $minute = date('i', strtotime($dateTime));
                $second = date('s', strtotime($dateTime));
                $ymd = date('Ymd', strtotime($dateTime));
                $num = floor(((($hour * 60) + $minute) * 60 + $second) / $lottery_frequency);
                $qishu = $ymd . sprintf("%03d", $num);
                break;
            case 'SSRC':
                $time = date('H:i:s', strtotime($dateTime));
                if (date('H:i:s', strtotime($time)) > '03:59:59' && date('H:i:s', strtotime($time)) < '10:01:30') { //假設是關盤
                    return false;
                }
                //$sql = 'SELECT * FROM lottery_schedule where type = "ssrc" and "'.$time.'" between fenpan_time and kaijiang_time';
                $sql = 'SELECT * FROM lottery_schedule where type = "ssrc" and (kaijiang_time <= "' . $time . '") ORDER BY kaijiang_time desc limit 1';
                $db = Yii::$app->db;
                $scheduleinfo = $db->createCommand($sql)->queryOne(); //抓出目前該彩種開到哪一期了
                if (!$scheduleinfo) {
                    echo 'no quish(' . $time . ')';
                    return false;
                }
                $isLateNight = false;
                if (date('H:i', strtotime($time)) > '00:00' && date('H:i', strtotime($time)) < '04:00') {
                    $isLateNight = true;
                }
                $isLateNight == true ? $time = strtotime($dateTime) - 86400 : $time = strtotime($dateTime);
                $qishu = date('Ymd', $time) . sprintf("%04d", $scheduleinfo['qishu']);
                break;
            case 'ORPK':
                $time = date('H:i:s', strtotime($dateTime));
                if (date('H:i:s', strtotime($time)) > '03:59:59' && date('H:i:s', strtotime($time)) < '10:01:30') { //假設是關盤
                    return false;
                }
                //$sql = 'SELECT * FROM lottery_schedule where type = "ssrc" and "'.$time.'" between fenpan_time and kaijiang_time';
                $sql = 'SELECT * FROM lottery_schedule where type = "orpk" and (kaijiang_time <= "' . $time . '") ORDER BY kaijiang_time desc limit 1';
                $db = Yii::$app->db;
                $scheduleinfo = $db->createCommand($sql)->queryOne(); //抓出目前該彩種開到哪一期了
                if (!$scheduleinfo) {
                    echo 'no quish(' . $time . ')';
                    return false;
                }
                $isLateNight = false;
                if (date('H:i', strtotime($time)) > '00:00' && date('H:i', strtotime($time)) < '04:00') {
                    $isLateNight = true;
                }
                $isLateNight == true ? $time = strtotime($dateTime) - 86400 : $time = strtotime($dateTime);
                $qishu = date('Ymd', $time) . sprintf("%04d", $scheduleinfo['qishu']);
                break;
            default:

                break;
        }
        return $qishu;
    }

    #取得開獎時間
    public function getDateTime($qishu, $type)
    {
        switch ($type) {
            case 'TJ':
                $num = (int) substr($qishu, -3);
                $second = $num * 108;
                $baseTime = substr($qishu, 0, 4) . '-' . substr($qishu, 4, 2) . '-' . substr($qishu, 6, 2) . ' 00:00:00';
                $dateTime = date('Y-m-d H:i:s', strtotime($baseTime . ' + ' . $second . ' second'));
                break;
            case 'SSRC':
                $num = (int) substr($qishu, -4);
                $baseTime = substr($qishu, 0, 4) . '-' . substr($qishu, 4, 2) . '-' . substr($qishu, 6, 2);
                $sql = "SELECT kaijiang_time FROM lottery_schedule WHERE lottery_type='极速赛车' and qishu = '$num'";
                $db = Yii::$app->db;
                $data = $db->createCommand($sql)->queryOne(); //用quish找開獎時間
                $dateTime = date('Y-m-d H:i:s', strtotime($baseTime . ' ' . $data['kaijiang_time']));
                break;
            case 'ORPK':
                $num = (int) substr($qishu, -4);
                $baseTime = substr($qishu, 0, 4) . '-' . substr($qishu, 4, 2) . '-' . substr($qishu, 6, 2);
                $sql = "SELECT kaijiang_time FROM lottery_schedule WHERE lottery_type='老PK拾' and qishu = '$num'";
                $db = Yii::$app->db;
                $data = $db->createCommand($sql)->queryOne(); //用quish找開獎時間
                $dateTime = date('Y-m-d H:i:s', strtotime($baseTime . ' ' . $data['kaijiang_time']));
                break;
            default:
                # code...
                break;
        }
        return $dateTime;
    }

    public function awardBuild($type, $config)
    {

        $result = [
            'count' => 0,
        ];
        $db = Yii::$app->db;
        if ($type == 'TJ') {
            $awardTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 second'));
        } else {
            $awardTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -0 second'));
        }
        // var_dump($type);
        // $awardTime = date('Y-m-d H:i:s', strtotime('2019-02-23 04:01:30'));
        // var_dump($awardTime);

        $sql = 'SELECT * FROM ' . $config['table'] . ' order by qishu desc limit 1';
        $data = $db->createCommand($sql)->queryOne(); //抓出目前該彩種開到哪一期了

        if ($data == '') { //假設從未開過獎抓5分鐘前的期數
            $strQishu = $this->getQishu(date('Y-m-d H:i:00', strtotime($awardTime . ' -5 minute')), $config['lottery_frequency'], $type, $config['name']);
        } else {
            $strQishu = $data['qishu'];

            //預開獎先行偵測是否開到
            if (strtotime($data['datetime']) > strtotime($awardTime)) {
                $strQishu = $this->getQishu(date('Y-m-d H:i:00', strtotime($awardTime . ' -5 minute')), $config['lottery_frequency'], $type, $config['name']);
            }
        }

        //test
        //$awardTime = date('Y-m-d H:i:s', strtotime('2019-02-21 04:01:16'));
        $endQishu = $this->getQishu($awardTime, $config['lottery_frequency'], $type, $config['name']); //找出上一期的期數
        //test
        //$endQishu = $this->getQishu($awardTime,$config['lottery_frequency'],$type,$config['name']);//找出上一期的期數
        if ($type == 'SSRC' || $type == 'ORPK') {
            if (!($endQishu) || !($strQishu)) //假設沒撈到資料
            {
                echo 'no data!';
                return false;
            }
        }

        $strDate = date('Y-m-d 00:00:00', strtotime($this->getDateTime($strQishu, $type)));
        $endDate = date('Y-m-d H:i:s', strtotime($this->getDateTime($endQishu, $type)));
        $dateDiff = max(1, ceil((strtotime($endDate) - strtotime($strDate)) / 3600 / 24));

        //var_dump($endQishu);
        $result['strQishu'] = $strQishu;
        $result['endQishu'] = $endQishu;
        switch ($type) {
            case 'TJ': //計算勝率後開獎
                for ($d = 1; $d <= $dateDiff; $d++) {
                    $currDate = date('Ymd', strtotime($strDate . ($d - 1) . ' day'));
                    switch ($d) {
                        case 1:
                            if (substr($strQishu, 0, 8) == $currDate) {
                                $strNum = (int) substr($strQishu, -3) + 1;
                            } else {
                                $strNum = 1;
                            }
                            if ($dateDiff == 1) {
                                $endNum = (int) substr($endQishu, -3);
                            } else {
                                $endNum = 800;
                            }
                            break;
                        case $dateDiff:
                            $strNum = 1;
                            $endNum = (int) substr($endQishu, -3);
                            break;
                        default:
                            $strNum = 1;
                            $endNum = 800;
                            break;
                    }
                    for ($i = $strNum; $i <= $endNum; $i++) {
                        $qishu = $currDate . sprintf("%03d", $i);
                        //var_dump($qishu); exit;
                        $dateTime = $this->getDateTime($qishu, $type);
                        //echo $qishu .PHP_EOL;
                        if ($endQishu >= $qishu) {

                            //因應預開彩，先行檢測是否開獎
                            $temp = "SELECT * FROM " . $config['table'] . " where qishu ='" . $qishu . "'";
                            $check = $db->createCommand($temp)->queryOne();

                            if (empty($check)) {
                                $this->save($qishu, $dateTime, $type, $config);
                                $result['count']++;
                            }

                        } else {
                            #防止跑超過目前要跑的最大筆數，超過直接break
                            break;
                        }
                    }
                }
                break;
            case 'SSRC':
                for ($d = 1; $d <= $dateDiff; $d++) {
                    $currDate = date('Ymd', strtotime($strDate . ($d - 1) . ' day'));
                    switch ($d) {
                        case 1:
                            if (substr($strQishu, 0, 8) == $currDate) {
                                $strNum = (int) substr($strQishu, -4) + 1;
                            } else {
                                $strNum = 720;
                            }
                            if ($dateDiff == 1) {
                                $endNum = (int) substr($endQishu, -4);
                            } else {
                                $endNum = 720;
                            }
                            break;
                        case $dateDiff:
                            $strNum = 1;
                            $endNum = (int) substr($endQishu, -4);
                            break;
                        default:
                            $strNum = 1;
                            $endNum = 720;
                            break;
                    }

                    for ($i = $strNum; $i <= $endNum; $i++) {
                        $qishu = $currDate . sprintf("%04d", $i);
                        $dateTime = $this->getDateTime($qishu, $type);
                        echo $qishu . PHP_EOL;
                        if ($endQishu >= $qishu) {
                            if ((int) substr($qishu, -4) > 559) { #跨天
                            $dateTime = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($dateTime)));
                            }
                            //$this->saveByRand($qishu, $dateTime, $config);    //亂數開獎
                            //因應預開彩，先行檢測是否開獎
                            $temp = "SELECT * FROM " . $config['table'] . " where qishu ='" . $qishu . "'";
                            $check = $db->createCommand($temp)->queryOne();

                            if (empty($check)) {
                                $this->save($qishu, $dateTime, $type, $config);
                                $result['count']++;
                            }
                        } else {
                            #防止跑超過目前要跑的最大筆數，超過直接break
                            break;
                        }
                    }
                }

                break;
            case 'ORPK':
                for ($d = 1; $d <= $dateDiff; $d++) {
                    $currDate = date('Ymd', strtotime($strDate . ($d - 1) . ' day'));
                    switch ($d) {
                        case 1:
                            if (substr($strQishu, 0, 8) == $currDate) {
                                $strNum = (int) substr($strQishu, -4) + 1;
                            } else {
                                $strNum = 168;
                            }
                            if ($dateDiff == 1) {
                                $endNum = (int) substr($endQishu, -4);
                            } else {
                                $endNum = 168;
                            }
                            break;
                        case $dateDiff:
                            $strNum = 1;
                            $endNum = (int) substr($endQishu, -4);
                            break;
                        default:
                            $strNum = 1;
                            $endNum = 168;
                            break;
                    }

                    for ($i = $strNum; $i <= $endNum; $i++) {
                        $qishu = $currDate . sprintf("%04d", $i);
                        $dateTime = $this->getDateTime($qishu, $type);
                        echo $qishu . PHP_EOL;
                        if ($endQishu >= $qishu) {
                            if ((int) substr($qishu, -4) > 559) { #跨天
                            $dateTime = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($dateTime)));
                            }
                            //$this->saveByRand($qishu, $dateTime, $config);    //亂數開獎
                            //因應預開彩，先行檢測是否開獎
                            $temp = "SELECT * FROM " . $config['table'] . " where qishu ='" . $qishu . "'";
                            $check = $db->createCommand($temp)->queryOne();

                            if (empty($check)) {
                                $this->save($qishu, $dateTime, $type, $config);
                                $result['count']++;
                            }
                        } else {
                            #防止跑超過目前要跑的最大筆數，超過直接break
                            break;
                        }
                    }
                }

                break;
            default:
                # code...
                break;
        }
        print_r($result);
        return $result;
    }

    private function save($qishu, $awardTime, $type, $config)
    {
        $db = Yii::$app->db;

        if (date('H:i') > '00:00' && date('H:i') <= '00:05') {
            $this->clear_build_add();
        }

        switch ($type) {
            case 'TJ':
                $sql = 'SELECT * FROM odds_lottery_normal where lottery_type = "' . $config['name'] . '" and sub_type = "RATE" ';
                $data = $db->createCommand($sql)->queryOne();
                if ($data != '') {
                    $config['build_type'] = $data['h3'];
                    $config['lottery_rate'] = $data['h0'];
                }
                break;
            case 'SSRC':
                $sql = 'SELECT * FROM odds_lottery where lottery_type = "' . $config['name'] . '" and sub_type = "RATE" ';
                $data = $db->createCommand($sql)->queryOne();
                if ($data != '') {
                    $config['build_type'] = $data['h3'];
                    $config['lottery_rate'] = $data['h1'];
                }
                break;
            case 'ORPK':
                $sql = 'SELECT * FROM odds_lottery where lottery_type = "' . $config['name'] . '" and sub_type = "RATE" ';
                $data = $db->createCommand($sql)->queryOne();
                if ($data != '') {
                    $config['build_type'] = $data['h3'];
                    $config['lottery_rate'] = $data['h1'];
                }
                break;
        }

        #使用開獎方式
        #0.隨機(目前SSRC開獎機制)
        #1.新會員誘彩（針對後台勾選會員）
        #2.莊家勝率（目前TJ、SPLHC開獎機制）
        $build_type = $config['build_type'];
        $result = [];
        switch ($build_type) {
            case 0:
                $result = $this->simulation01($config, $type);
                break;
            case 1:
                $result = $this->simulation02($qishu, $awardTime, $type, $config);
                //print_r($result);
                //return false;
                break;
            case 2: //
                $result = $this->simulation03($qishu, $type, $config);
                break;
        }

        $fieldArray = ['qishu', 'create_time', 'datetime'];
        //'ball_1', 'ball_2', 'ball_3', 'ball_4', 'ball_5',
        $ballField = [];
        for ($i = 1; $i <= $config['awardBalls']; $i++) {
            $ballField[] = 'ball_' . $i;
        }

        $fieldArray = array_merge($fieldArray, $ballField);
        $fieldArray = array_merge($fieldArray, ['sum_bet_money', 'sum_win', 'scale']);

        //修正 create_time 錯置問題
        $valueArray[0] = [
            'qishu' => $qishu,
            'create_time' => date('Y-m-d H:i:s'),
            'datetime' => $awardTime,
        ];

        $valueArray[0] += $result;
        //print_r($ballField);
        //print_r($fieldArray);
        //print_r($valueArray[0]);
        //exit;
        #新增開獎記錄
        $sql = $db->queryBuilder->batchInsert($config['table'], $fieldArray, $valueArray);
        $db->createCommand($sql)->execute();
    }

    #開獎排程存檔
    private function saveSchecule($qishu, $kaipan_time, $fenpan_time, $kaijiang_time)
    {
        $db = Yii::$app->db;
        $user_table = 'lottery_schedule';
        $fieldArray = ['id', 'lottery_type', 'qishu', 'kaipan_time', 'fenpan_time', 'kaijiang_time', 'state', 'type'];
        $valueArray[0] = [
            'id' => 1500 + (int) $qishu,
            'lottery_type' => '极速时时彩',
            'qishu' => $qishu,
            'kaipan_time' => $kaipan_time,
            'fenpan_time' => $fenpan_time,
            'kaijiang_time' => $kaijiang_time,
            'state' => '',
            'type' => 'tjssc',
        ];

        $sql = $db->queryBuilder->batchInsert($user_table, $fieldArray, $valueArray);
        $db->createCommand($sql)->execute();
    }

    #開獎產生方式 - 隨機(目前SSRC開獎機制)
    private function simulation01($config, $type)
    {
        $rand_array = [];
        $result = [];
        $db = Yii::$app->db;
        $awardBalls = (int) $config['awardBalls']; //有幾個號碼
        switch ($type) {
            case 'TJ':
                for ($i = 1; $i <= $awardBalls; $i++) {
                    array_push($rand_array, rand(0, 9)); //亂數放入0~9
                }
                break;
            case 'SSRC':
                for ($i = 1; $i <= $awardBalls; $i++) {
                    array_push($rand_array, $i); //依序放入(ex. 1~10)
                }
                shuffle($rand_array); //打亂排列順序
                break;
            case 'ORPK':
                for ($i = 1; $i <= $awardBalls; $i++) {
                    array_push($rand_array, $i); //依序放入(ex. 1~10)
                }
                shuffle($rand_array); //打亂排列順序
                break;
        }
        for ($i = 1; $i <= $awardBalls; $i++) {
            $result['ball_' . $i] = $rand_array[$i - 1];
        }
        //亂數開獎先不統計
        $result['sum_bet_money'] = 0;
        $result['sum_win'] = 0;
        $result['scale'] = 0;
        return $result;
    }

    #開獎產生方式 - 新會員誘彩（針對後台勾選會員）
    private function simulation02($qishu, $awardTime, $type, $config)
    {
        $db = Yii::$app->db;
        $awardBalls = $config['awardBalls'];
        $result = [];
        $temp_result = [];
        $curdate = date('Y-m-d', strtotime($awardTime));
        $qishudate = substr($qishu, 0, 8);

        #1.新增有存款會員記錄至Add
        $sql = 'insert into lottery_build_add (user_id, date, total_deposit, created_at, created_user)
				SELECT
					m1.user_id,
					DATE_FORMAT(m1.`update_time`, "%Y-%m-%d") as sdate,
					ifnull(sum(m1.order_value),0) as total_deposit,
					now(), 57
				from
					money m1
				where
					m1.`status` = "成功"
					and m1.type in ("银行汇款","在线支付")
					and DATE_FORMAT(m1.`update_time`, "%Y-%m-%d") = curdate()
				group by
					m1.user_id, sdate
				ON DUPLICATE KEY UPDATE total_deposit = VALUES(total_deposit)';
        $db->createCommand($sql)->execute();

        #2.本期投注新註冊會員& 更新彩票下注及贏分
        $sql = 'insert into lottery_build_add (user_id, date, ' . strtolower($type) . '_bet_money, ' . strtolower($type) . '_win, created_at, created_user)
				select
					distinct o1.user_id, DATE_FORMAT(o1.bet_time, "%Y-%m-%d") as sdate,
					sum(o2.bet_money) as total_bet_money,
					sum(case when o2.status = 1 and o2.is_win = 1 then o2.win else 0 end) as total_win,
					now(), 57
				from
					order_lottery o1
					inner join order_lottery_sub o2 on o1.order_num = o2.order_num
					inner join lottery_build_add a1 on o1.user_id = a1.user_id
					and a1.date = curdate() and a1.' . strtolower($type) . '_flag = "1"
				where
					o1.bet_time between "' . $curdate . ' 00:00:00" and "' . $curdate . ' 23:59:59"
					and o1.GType = "' . $type . '"
				group by user_id, sdate
				ON DUPLICATE KEY UPDATE ' . strtolower($type) . '_bet_money = VALUES(' . strtolower($type) . '_bet_money), ' . strtolower($type) . '_win = VALUES(' . strtolower($type) . '_win)';
        $db->createCommand($sql)->execute();

        #3.查詢今天是否有可以增加開獎率的會員
        $sql = 'select
					o2.quick_type, o2.number as snumber, o2.bet_rate, sum(o2.bet_money) as total_bet_money, sum(o2.win) as total_win
				from
					lottery_build_add a1
					inner join order_lottery o1 on o1.user_id = a1.user_id and o1.Gtype = "' . $type . '" and o1.lottery_number = "' . $qishu . '"
					inner join order_lottery_sub o2 on o1.order_num = o2.order_num
				where
					a1.date = curdate()
					and a1.status = "Y"
					and (a1.total_deposit * 1.5) > ((a1.tj_win - a1.tj_bet_money) + (a1.ssrc_win - a1.ssrc_bet_money) + (a1.orpk_win - a1.orpk_bet_money) + (a1.spsix_win - a1.spsix_bet_money))
				group by
					o2.quick_type, snumber
				having
					#CAST(snumber AS DECIMAL(10,2)) > 0 or snumber in ("大","小","单","双")
					(snumber REGEXP "[^0-9.]") = 0 or snumber in ("大","小","单","双")
				order by
					total_win asc';
        //echo $sql;
        //exit;
        $data = $db->createCommand($sql)->queryAll();
        if (count($data) > 0) {
            #取得新註冊會員 - 贏分最少的前10個號碼
            //$add_num = array_column(array_slice($data, 0, 10), 'snumber');
            #取得前10筆
            $add_num = array_slice($data, 0, 10);

            #模擬開獎
            $SpCheckout = new SpCheckout();

            #RTP
            if (!isset($config['lottery_rate'])) {
                $lottery_rate = 0.1; //假設目前設定開獎比在0.1
            } else {
                $lottery_rate = $config['lottery_rate'];
            }

            /*----20181004----*/
            $rate_deviation = 0.15; //設定誤差值
            $already_check = 'N';
            $check_result = [];

            $checkOrder = 'N'; //是否檢查訂單
            $except_num = []; //排除開獎號碼
            //$lock_array = [];        //是否鎖住開獎號碼

            for ($i = 1; $i <= 10; $i++) {
                $temp_result[$i] = [
                    'qishu' => $qishu,
                    'datetime' => date('Y-m-d H:i:s'),
                ];

                if (isset($add_num[$i - 1])) {
                    $assign_array = $add_num[$i - 1];
                } else {
                    $assign_array = $add_num[0];
                }

                //print_r($assign_array);
                $quick_type = $assign_array['quick_type'];
                $assign_ball = $this->str2num($quick_type);
                $assign_num = $this->getBall($config['startNumber'], $config['endNumber'], $assign_array['snumber']);
                $temp_result[$i]['ball_' . $assign_ball] = $assign_num;
                //echo $config['startNumber'] . '__' . $config['endNumber'] . '__' . $assign_num;
                //exit;

                $seq = 1;
                do {
                    if (!isset($temp_result[$i]['ball_' . $seq])) {
                        $ball = $this->getBall($config['startNumber'], $config['endNumber']);
                        if (!in_array($ball, $temp_result[$i]) && !in_array($ball, $except_num)) {
                            //$seq = count($temp_result[$i]) + 1;
                            $temp_result[$i]['ball_' . $seq] = $ball;
                            $seq++;
                        }
                    } else {
                        $seq++;
                    }
                } while ($seq <= $awardBalls);

                //print_r($temp_result);

                #計算開獎結果輸贏佔比，是否在設定的範圍
                $simulation = $SpCheckout->actionLotteryCheckout($type, $config['awardBalls'], $qishu, '0', 'Y', $temp_result[$i], $checkOrder);
                $temp_result[$i]['simulation'] = $simulation;
                //echo @$simulation['scale'] .'>= (1-'.$lottery_rate.'-'.$rate_deviation.') &&'. @$simulation['scale'] .'<= (1-'.$lottery_rate.'+'.$rate_deviation.PHP_EOL;
                //print_r($temp_result);
                //exit;
                //if((@$simulation['scale'] >= (1-$lottery_rate-$rate_deviation) && @$simulation['scale'] <= (1-$lottery_rate+$rate_deviation)) || @$simulation['sum_bet_money'] == 0){
                if ((@$simulation['scale'] >= 1 && @$simulation['scale'] <= 1.5) || @$simulation['sum_bet_money'] == 0) {
                    $already_check = 'Y';
                    $check_result = $temp_result[$i];
                    break;
                } else {
                    $checkOrder = 'Y';
                    #如果開獎結果低於設定機率的下限，要繼續跑時，lock目前必出的號碼
                    //if(@$simulation['scale'] < (1-$lottery_rate)){
                    //    $lock_array[] = $assign_ball;
                    //}
                }
            }
            print_r($temp_result);
            echo '========' . PHP_EOL;
            //exit;

            if ($already_check == 'N') {
                $minScale = 1.5; //輸贏佔比，可以隨便設一個值，夠大就好
                $lastScale = 0; //最後一筆輸贏佔比
                foreach ($temp_result as $key1 => $value1) {
                    //if( (1 - $lottery_rate) > @$value1['simulation']['scale'] && (1 - $lottery_rate - @$value1['simulation']['scale']) < $minScale){
                    //if((1 - $lottery_rate) <= @$value1['simulation']['scale'] && @$value1['simulation']['scale'] < $minScale){
                    if ((@$value1['simulation']['scale'] >= 0.7 && @$value1['simulation']['scale'] < 1.5) || count($result) == 0) {
                        echo '【' . $key1 . '】';
                        if (@$value1['simulation']['scale'] <= $minScale && @$value1['simulation']['scale'] > $lastScale) {
                            for ($i = 1; $i <= $config['awardBalls']; $i++) {
                                $result['ball_' . $i] = $value1['ball_' . $i];
                            }
                            $result['sum_bet_money'] = @$value1['simulation']['sum_bet_money'];
                            $result['sum_win'] = @$value1['simulation']['sum_win'];
                            $result['scale'] = @$value1['simulation']['scale'];
                            $lastScale = @$value1['simulation']['scale'];
                        }
                        //$minScale = abs(1 - $lottery_rate - @$value1['simulation']['scale']);
                    }
                }
            } else {
                for ($i = 1; $i <= $config['awardBalls']; $i++) {
                    $result['ball_' . $i] = $check_result['ball_' . $i];
                }
                $result['sum_bet_money'] = @$check_result['simulation']['sum_bet_money'];
                $result['sum_win'] = @$check_result['simulation']['sum_win'];
                $result['scale'] = @$check_result['simulation']['scale'];
            }

            //print_r($result);
            //exit;

            return $result;
        } else {
            return $this->simulation03($qishu, $type, $config);
        }
    }

    /*
    中文轉數字
     */
    private function str2num($quick_type = '')
    {
        switch ($quick_type) {
            case '冠军':
                $num = 1;
                break;
            case '亚军':
                $num = 2;
                break;
            default:
                $str = mb_substr($quick_type, 1, 1);
                $charArray = ['', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十'];
                $num = array_search($str, $charArray);
                break;
        }
        return $num;
    }

    #開獎產生方式 - 莊家勝率（目前TJ、SPLHC開獎機制）
    private function simulation03($qishu, $type, $config)
    {
        $db = Yii::$app->db;
        $awardBalls = $config['awardBalls'];
        $result = [];
        $temp_result = [];
        $SpCheckout = new SpCheckout();

        #RTP
        if (!isset($config['lottery_rate'])) {
            $lottery_rate = 0.1; //假設目前設定開獎比在0.1
        } else {
            $lottery_rate = $config['lottery_rate'];
        }

        /*----20181004----*/
        $rate_deviation = 0.05; //設定誤差值
        $already_check = 'N';
        $check_result = [];

        $checkOrder = 'N'; //是否檢查訂單
        $except_num = []; //排除開獎號碼
        for ($i = 1; $i <= 30; $i++) {
            $temp_result[$i] = [
                'qishu' => $qishu,
                'datetime' => date('Y-m-d H:i:s'),
            ];

            $seq = 0;
            do {
                $ball = $this->getBall($config['startNumber'], $config['endNumber']);
                if (!in_array($ball, $temp_result[$i]) && !in_array($ball, $except_num)) {
                    //$seq = count($temp_result[$i]) + 1;
                    $seq++;
                    $temp_result[$i]['ball_' . $seq] = $ball;
                }
            } while ($seq < $awardBalls);
            #計算開獎結果輸贏佔比，是否在設定的範圍
            $simulation = $SpCheckout->actionLotteryCheckout($type, $config['awardBalls'], $qishu, '0', 'Y', $temp_result[$i], $checkOrder);
            $temp_result[$i]['simulation'] = $simulation;

            if ((@$simulation['scale'] >= (1 - $lottery_rate - $rate_deviation) && @$simulation['scale'] <= (1 - $lottery_rate + $rate_deviation))
                || @$simulation['sum_bet_money'] == 0) {
                $already_check = 'Y';
                $check_result = $temp_result[$i];
                break;
            } else {
                /* 追蹤用記錄，00 表示測試失敗超過區間 */
                /*
                $sql = 'INSERT INTO spssc_lottery_self_num(qishu, ball_1, ball_2, ball_3, ball_4, ball_5, sum_bet_money, sum_win, scale, userscale)
                VALUES ('.$qishu.'00,'.@$temp_result[$i]['ball_1'].', '.@$temp_result[$i]['ball_2'].', '.@$temp_result[$i]['ball_3'].', '.@$temp_result[$i]['ball_4'].', '.@$temp_result[$i]['ball_5'].'
                , '.@$simulation['sum_bet_money'].', '.@$simulation['sum_win'].', '.@$simulation['scale'].', '.(1-$lottery_rate).')';
                $db->createCommand($sql)->execute();
                 */
                $checkOrder = 'Y';
            }
        }

        if ($already_check == 'N') {
            $minScale = 1000; //輸贏佔比，可以隨便設一個值，夠大就好
            foreach ($temp_result as $key1 => $value1) {
                if (1 >= @$value1['simulation']['scale'] && (1-@$value1['simulation']['scale']) < $minScale) {
                    for ($i = 1; $i <= $config['awardBalls']; $i++) {
                        $result['ball_' . $i] = $value1['ball_' . $i];
                    }
                    $result['sum_bet_money'] = @$value1['simulation']['sum_bet_money'];
                    $result['sum_win'] = @$value1['simulation']['sum_win'];
                    $result['scale'] = @$value1['simulation']['scale'];
                    $minScale = abs(1 - $lottery_rate-@$value1['simulation']['scale']);
                }
            }
        } else {
            for ($i = 1; $i <= $config['awardBalls']; $i++) {
                $result['ball_' . $i] = $check_result['ball_' . $i];
            }
            $result['sum_bet_money'] = @$check_result['simulation']['sum_bet_money'];
            $result['sum_win'] = @$check_result['simulation']['sum_win'];
            $result['scale'] = @$check_result['simulation']['scale'];
        }

        return $result;
    }

    /*
    刪除誘彩記錄
     */
    private function clear_build_add()
    {
        $db = Yii::$app->db;
        $sql = 'delete from lottery_build_add where date <> curdate()';
        $db->createCommand($sql)->execute();
    }
}
