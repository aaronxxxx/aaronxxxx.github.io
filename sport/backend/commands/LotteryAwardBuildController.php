<?php
/**
 * @auth ada
 * @date 2018-08-17 10:00
 * @2018-09-04 改成在本機開獎
 * @彩票開獎
 */

namespace app\commands;

use app\common\controllers\SixCheckoutController as SixCheckout;
use Yii;
use yii\console\Controller;

/**
 * 1.每5分鐘產生開獎記錄AM 10:00 ~ 隔天AM04:00 算同一天期別
 */
class LotteryAwardBuildController extends Controller
{
    /**
     */
    public function actionIndex()
    {
        $lotteryConfig = [
            'SPSIX' => [
                'name' => '极速六合彩',
                'startNumber' => 1, //開始號碼
                'endNumber' => 49, //結束號碼
                'awardBalls' => 7, //開獎球數
                'table' => 'lottery_result_splhc',
                'build_type' => 2, //開獎產生方式
            ],
        ];

        foreach ($lotteryConfig as $key1 => $value1) {
            $result = $this->awardBuild($key1, $value1);
        }
        $this->setSchedule();
        print_r($result);
    }

    #取得開獎球號
    public function getBall($startNumber, $endNumber, $ratioNumber = [])
    {
        if (count($ratioNumber) > 0) {
            $pool = [];
            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $pool[] = $i;
            }
            $pool = array_merge($pool, $ratioNumber, $ratioNumber); //加2次新註冊會員投注陣列
            $randKey = array_rand($pool);
            return $pool[$randKey];
        } else {
            return rand($startNumber, $endNumber);
        }
    }

    #取得開獎期別
    public function getQishu($dateTime)
    {
        $hour = date('H', strtotime($dateTime));
        $minute = date('i', strtotime($dateTime));
        if ($hour < 10) {
            $ymd = date('Ymd', strtotime($dateTime . ' -1 day'));
            $num = floor((($hour * 60) + $minute + (60 * 14)) / 5); //凌晨要加上14小時
        } else {
            $ymd = date('Ymd', strtotime($dateTime));
            $num = floor((($hour * 60) + $minute - 600) / 5);
        }

        $qishu = $ymd . sprintf("%03d", $num);
        return $qishu;
    }

    #取得開獎時間
    public function getDateTime($qishu)
    {
        $num = (int) substr($qishu, -3);
        $minute = $num * 5;
        $baseTime = substr($qishu, 0, 4) . '-' . substr($qishu, 4, 2) . '-' . substr($qishu, 6, 2) . ' 10:00:00';
        $dateTime = date('Y-m-d H:i:00', strtotime($baseTime . $minute . ' minute'));
        return $dateTime;
    }

    public function awardBuild($type, $config)
    {
        $result = [
            'count' => 0,
        ];
        $db = Yii::$app->db;

        $awardTime = date('Y-m-d H:i:00');
        //$awardTime = '2018-08-19 04:20:00';     //test by currTime

        //時間為 4 -10 以4點為最後時間計算
        if (date('H', strtotime($awardTime)) > 4 && date('H', strtotime($awardTime)) < 10) {
            $awardTime = date('Y-m-d 04:00:00', strtotime($awardTime));
        }

        $sql = 'SELECT * FROM lottery_result_splhc order by qishu desc limit 1';
        $data = $db->createCommand($sql)->queryOne();

        if ($data == '') {
            $strQishu = $this->getQishu(date('Y-m-d H:i:00', strtotime($awardTime . ' -5 minute')));
        } else {
            $strQishu = $data['qishu'];

            //預開獎先行偵測是否開到
            if (strtotime($data['datetime']) > strtotime($awardTime)) {
                $strQishu = $this->getQishu(date('Y-m-d H:i:00', strtotime($awardTime . ' -5 minute')));
            }

        }
        $endQishu = $this->getQishu($awardTime);

        if (date('H', strtotime($this->getDateTime($strQishu))) < 10) {
            $strDate = date('Y-m-d 00:00:00', strtotime($this->getDateTime($strQishu) . ' -1 day'));
        } else {
            $strDate = date('Y-m-d 00:00:00', strtotime($this->getDateTime($strQishu)));
        }
        $endDate = date('Y-m-d H:i:s', strtotime($this->getDateTime($endQishu)));
        $dateDiff = max(1, ceil((strtotime($endDate) - strtotime($strDate)) / 3600 / 24));

        $result['strQishu'] = $strQishu;
        $result['endQishu'] = $endQishu;

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
                        $endNum = 216;
                    }
                    break;
                case $dateDiff:
                    $strNum = 1;
                    $endNum = (int) substr($endQishu, -3);
                    break;
                default:
                    $strNum = 1;
                    $endNum = 216;
                    break;
            }

            for ($i = $strNum; $i <= $endNum; $i++) {
                $qishu = $currDate . sprintf("%03d", $i);
                $dateTime = $this->getDateTime($qishu);
                //echo $qishu .PHP_EOL;
                if ($endQishu >= $qishu) {

                    //因應預開彩，先行檢測是否開獎
                    $temp = "SELECT * FROM lottery_result_splhc where qishu ='" . $qishu . "'";
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
        return $result;
    }

    private function save($qishu, $awardTime, $type, $config)
    {
        $db = Yii::$app->db;

        if (date('H:i') > '00:00' && date('H:i') <= '00:05') {
            $this->clear_build_add();
        }

        $sql = 'SELECT * FROM spsix_lottery_odds where sub_type = "RATE" and ball_type = "other"';
        $data = $db->createCommand($sql)->queryOne();
        if ($data != '') {
            $config['build_type'] = (int) $data['h3'];
            $config['lottery_rate'] = $data['h1'];
        }

        #使用開獎方式
        #0.隨機(目前SSRC開獎機制)
        #1.新會員誘彩（針對後台勾選會員）
        #2.莊家勝率（目前TJ、SPLHC開獎機制）
        $build_type = $config['build_type'];
        $result = [];
        switch ($build_type) {
            case 0:
                $result = $this->simulation01($config);
                //print_r($result);
                //return false;
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
        $fieldArray = ['qishu', 'create_time', 'datetime', 'ball_1', 'ball_2', 'ball_3', 'ball_4', 'ball_5', 'ball_6', 'ball_7', 'sum_bet_money', 'sum_win', 'scale'];

        //修正 create_time 錯置問題
        $valueArray[0] = [
            'qishu' => $qishu,
            'create_time' => date('Y-m-d H:i:s'),
            'datetime' => $awardTime,
        ];

        $valueArray[0] += $result;

        #新增開獎記錄
        $sql = $db->queryBuilder->batchInsert($config['table'], $fieldArray, $valueArray);
        $db->createCommand($sql)->execute();
    }

    /*
    設定期別
    1.只留目前時間 ~ 後2天期別
    2.每天凌晨00:00 - 00:20 檢查更新
     */
    private function setSchedule()
    {
        #凌晨新增設定
        if (!(date('H:i') >= '00:00' && date('H:i') < '00:20')) {
            return false;
        }
        $result = [
            'count' => 0,
        ];
        $db = Yii::$app->db;

        $currTime = date('Y-m-d H:i:00');
        $strDate = date('Y-m-d', strtotime($currTime . ' -1 day'));
        $endDate = date('Y-m-d', strtotime($currTime . ' 1 day'));
        $dateDiff = ceil((strtotime($endDate) - strtotime($strDate)) / 3600 / 24);

        for ($d = 1; $d <= $dateDiff; $d++) {
            $currDate = date('Ymd', strtotime($strDate . ($d - 1) . ' day'));
            switch ($d) {
                default:
                    $strNum = 1;
                    $endNum = 216;
                    break;
            }

            for ($i = $strNum; $i <= $endNum; $i++) {
                $qishu = $currDate . sprintf("%03d", $i);
                $kaijiang_time = $this->getDateTime($qishu); //開獎
                $kaipan_time = date('Y-m-d H:i:s', strtotime($kaijiang_time . ' -5 minute,15 second')); //開盤
                $fenpan_time = date('Y-m-d H:i:s', strtotime($kaijiang_time . ' -15 second')); //封盤
                $this->saveSchecule($qishu, $kaipan_time, $fenpan_time, $kaijiang_time);
                $result['count']++;
            }
        }

        #刪除已失效排程
        $sql = 'delete from spsix_lottery_schedule where kaijiang_time < "' . $strDate . ' 00:00:00"';
        $db->createCommand($sql)->execute();
        return $result;
    }

    #開獎排程存檔
    private function saveSchecule($qishu, $kaipan_time, $fenpan_time, $kaijiang_time)
    {
        $db = Yii::$app->db;
        $user_table = 'spsix_lottery_schedule';
        $fieldArray = ['qishu', 'kaipan_time', 'fenpan_time', 'kaijiang_time', 'create_time'];
        $valueArray[0] = [
            'qishu' => $qishu,
            'kaipan_time' => $kaipan_time,
            'fenpan_time' => $fenpan_time,
            'kaijiang_time' => $kaijiang_time,
            'create_time' => date('Y-m-d H:i:s'),
        ];

        $sql = $db->queryBuilder->batchInsert($user_table, $fieldArray, $valueArray);
        $db->createCommand($sql . ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)')->execute();
    }

    #開獎產生方式 - 隨機(目前SSRC開獎機制)
    private function simulation01($config)
    {
        $awardBalls = $config['awardBalls'];
        $temp = [];
        $result = [];

        do {
            $ball = $this->getBall($config['startNumber'], $config['endNumber']);
            if (!in_array($ball, $temp)) {
                $temp[] = $ball;
            }
        } while (count($temp) < $awardBalls);

        for ($i = 1; $i <= count($temp); $i++) {
            $result['ball_' . $i] = $temp[$i - 1];
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
        /*
        $sql = 'insert into lottery_build_add (user_id, lottery_type, date, total_bet_money, total_win, created_at, created_user)
        select
        distinct o1.user_id, "SPSIX", DATE_FORMAT(o1.bet_time, "%Y-%m-%d") as sdate,
        sum(bet_money) as total_bet_money,
        sum(case when o2.status = 1 and o2.is_win = 1 then win else 0 end) as total_win,
        now(), 57
        from
        spsix_lottery_order o1
        inner join spsix_lottery_order_sub o2 on o1.order_num = o2.order_num
        inner join user_list u1 on o1.user_id = u1.user_id and u1.regtime >= DATE_SUB("'.$curdate.'", INTERVAL 2 DAY)
        where
        o1.lottery_number like "'.$qishudate.'%"
        group by user_id, sdate
        ON DUPLICATE KEY UPDATE user_id = VALUES(user_id), total_bet_money = VALUES(total_bet_money), total_win = VALUES(total_win)';
         */
        $sql = 'insert into lottery_build_add (user_id, date, ' . strtolower($type) . '_bet_money, ' . strtolower($type) . '_win, created_at, created_user)
				select
					distinct o1.user_id, DATE_FORMAT(o1.bet_time, "%Y-%m-%d") as sdate,
					sum(o2.bet_money) as total_bet_money,
					sum(case when o2.status = 1 and o2.is_win = 1 then o2.win else 0 end) as total_win,
					now(), 57
				from
					spsix_lottery_order o1
					inner join spsix_lottery_order_sub o2 on o1.order_num = o2.order_num
					inner join lottery_build_add a1 on o1.user_id = a1.user_id
					and a1.date = curdate() and a1.spsix_flag = "1"
				where
					o1.bet_time between "' . $curdate . ' 00:00:00" and "' . $curdate . ' 23:59:59"
				group by user_id, sdate
				ON DUPLICATE KEY UPDATE ' . strtolower($type) . '_bet_money = VALUES(' . strtolower($type) . '_bet_money), ' . strtolower($type) . '_win = VALUES(' . strtolower($type) . '_win)';

        $db->createCommand($sql)->execute();

        #3.查詢今天是否有可以增加開獎率的會員
        $sql = 'select
					o2.number as snumber, o2.bet_rate, sum(o2.bet_money) as total_bet_money, sum(o2.win) as total_win
				from
					lottery_build_add a1
					inner join spsix_lottery_order o1 on o1.user_id = a1.user_id and o1.lottery_number = "' . $qishu . '"
					inner join spsix_lottery_order_sub o2 on o1.order_num = o2.order_num
				where
					a1.date = curdate()
					and a1.spsix_flag = "1"
					and a1.status = "Y"
					and (a1.total_deposit * 1.5) > ((a1.tj_win - a1.tj_bet_money) + (a1.ssrc_win - a1.ssrc_bet_money) + (a1.spsix_win - a1.spsix_bet_money))
				group by
					snumber
				having
					#CAST(snumber AS DECIMAL(10,2)) > 0
					(snumber REGEXP "[^0-9.]") = 0
				order by
					total_win asc';
        $data = $db->createCommand($sql)->queryAll();
        if (count($data) > 0) {
            #取得新註冊會員 - 贏分最少的前10個號碼
            $add_num = array_column(array_slice($data, 0, 10), 'snumber');

            #模擬開獎
            $SixCheckout = new SixCheckout();

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

            for ($i = 1; $i <= 10; $i++) {
                $temp_result[$i] = [
                    'qishu' => $qishu,
                    'datetime' => date('Y-m-d H:i:s'),
                ];

                $seq = 0;
                do {
                    $ball = $this->getBall($config['startNumber'], $config['endNumber'], $add_num);
                    if (!in_array($ball, $temp_result[$i]) && !in_array($ball, $except_num)) {
                        //$seq = count($temp_result[$i]) + 1;
                        $seq++;
                        $temp_result[$i]['ball_' . $seq] = $ball;
                    }
                } while ($seq < $awardBalls);

                #計算開獎結果輸贏佔比，是否在設定的範圍
                $simulation = $SixCheckout->actionLotteryCheckout($type, 7, $qishu, '0', 'Y', $temp_result[$i], $checkOrder);
                $temp_result[$i]['simulation'] = $simulation;
                //echo @$simulation['scale'] .'>= (1-'.$lottery_rate.'-'.$rate_deviation.') &&'. @$simulation['scale'] .'<= (1-'.$lottery_rate.'+'.$rate_deviation.PHP_EOL;
                //print_r($temp_result);
                //exit;
                if ((@$simulation['scale'] >= (1 - $lottery_rate - $rate_deviation) && @$simulation['scale'] <= (1 - $lottery_rate + $rate_deviation))
                    || @$simulation['sum_bet_money'] == 0) {
                    $already_check = 'Y';
                    $check_result = $temp_result[$i];
                    break;
                } else {
                    /* 追蹤用記錄，00 表示測試失敗超過區間 */
                    // $sql = 'INSERT INTO spsix_lottery_self_num(qishu, ball_1, ball_2, ball_3, ball_4, ball_5, ball_6, ball_7, sum_bet_money, sum_win, scale, userscale)
                    // VALUES ('.$qishu.'00,'.@$temp_result[$i]['ball_1'].', '.@$temp_result[$i]['ball_2'].', '.@$temp_result[$i]['ball_3'].', '.@$temp_result[$i]['ball_4'].', '.@$temp_result[$i]['ball_5'].', '.@$temp_result[$i]['ball_6'].', '.@$temp_result[$i]['ball_7'].'
                    // , '.@$simulation['sum_bet_money'].', '.@$simulation['sum_win'].', '.@$simulation['scale'].', '.(1-$lottery_rate).')';
                    // $db->createCommand($sql)->execute();

                    #當中獎率的於1時，這些號碼下次不要開出
                    /*if(@$simulation['scale'] >= 1){
                    for($n=1; $n<=7; $n++){
                    $ball_num = @$simulation['ball_'.$n];
                    $except_num[$ball_num] = $ball_num;
                    }
                    }

                    #排除開獎金額最多前15個
                    if(count($simulation['checkOrderArray']) > 0){
                    $count_num = 0;
                    arsort($simulation['checkOrderArray']);
                    foreach($simulation['checkOrderArray'] as $key1 => $value1){
                    $count_num++;
                    if($count_num <= 15){
                    $except_num[$key1] = $key1;
                    }
                    }
                    }*/
                    #算太多次時，統計完每個號碼開獎結果再計，目前第2次開始就把開獎金額大的排除
                    //if($i == 3){
                    $checkOrder = 'Y';
                    //}
                }
            }

            if ($already_check == 'N') {
                $minScale = 1000; //輸贏佔比，可以隨便設一個值，夠大就好
                foreach ($temp_result as $key1 => $value1) {
                    if ((1 - $lottery_rate) > @$value1['simulation']['scale'] && (1 - $lottery_rate-@$value1['simulation']['scale']) < $minScale) {
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
        } else {
            return $this->simulation03($qishu, $type, $config);
        }
    }

    #開獎產生方式 - 莊家勝率（目前TJ、SPLHC開獎機制）
    private function simulation03($qishu, $type, $config)
    {
        $db = Yii::$app->db;
        $awardBalls = $config['awardBalls'];
        $result = [];
        $temp_result = [];
        $SixCheckout = new SixCheckout();

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
            $temp = [];
            do {
                $ball = $this->getBall($config['startNumber'], $config['endNumber']);
                if (!in_array($ball, $temp) && !in_array($ball, $except_num)) {
                    //$seq = count($temp_result[$i]) + 1;
                    $temp[] = $ball;
                    $seq++;
                    $temp_result[$i]['ball_' . $seq] = $ball;
                }
            } while ($seq < $awardBalls);
            #計算開獎結果輸贏佔比，是否在設定的範圍
            $simulation = $SixCheckout->actionLotteryCheckout('SPSIX', 7, $qishu, '0', 'Y', $temp_result[$i], $checkOrder);
            $temp_result[$i]['simulation'] = $simulation;

            if ((@$simulation['scale'] >= (1 - $lottery_rate - $rate_deviation) && @$simulation['scale'] <= (1 - $lottery_rate + $rate_deviation))
                || @$simulation['sum_bet_money'] == 0) {
                $already_check = 'Y';
                $check_result = $temp_result[$i];
                break;
            } else {
                /* 追蹤用記錄，00 表示測試失敗超過區間 */
                // $sql = 'INSERT INTO spsix_lottery_self_num(qishu, ball_1, ball_2, ball_3, ball_4, ball_5, ball_6, ball_7, sum_bet_money, sum_win, scale, userscale)
                // VALUES ('.$qishu.'00,'.@$temp_result[$i]['ball_1'].', '.@$temp_result[$i]['ball_2'].', '.@$temp_result[$i]['ball_3'].', '.@$temp_result[$i]['ball_4'].', '.@$temp_result[$i]['ball_5'].', '.@$temp_result[$i]['ball_6'].', '.@$temp_result[$i]['ball_7'].'
                // , '.@$simulation['sum_bet_money'].', '.@$simulation['sum_win'].', '.@$simulation['scale'].', '.(1-$lottery_rate).')';
                // $db->createCommand($sql)->execute();

                #當中獎率的於1時，這些號碼下次不要開出
                /*if(@$simulation['scale'] >= 1){
                for($n=1; $n<=7; $n++){
                $ball_num = @$simulation['ball_'.$n];
                $except_num[$ball_num] = $ball_num;
                }
                }

                #排除開獎金額最多前15個
                if(count($simulation['checkOrderArray']) > 0){
                $count_num = 0;
                arsort($simulation['checkOrderArray']);
                foreach($simulation['checkOrderArray'] as $key1 => $value1){
                $count_num++;
                if($count_num <= 15){
                $except_num[$key1] = $key1;
                }
                }
                }*/
                #算太多次時，統計完每個號碼開獎結果再計，目前第2次開始就把開獎金額大的排除
                //if($i == 3){
                $checkOrder = 'Y';
                //}
            }
        }

        if ($already_check == 'N') {
            $minScale = 1000; //輸贏佔比，可以隨便設一個值，夠大就好
            foreach ($temp_result as $key1 => $value1) {
                if ((1 - $lottery_rate) > @$value1['simulation']['scale'] && (1 - $lottery_rate-@$value1['simulation']['scale']) < $minScale) {
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

//        if($temp_result[1]['simulation']['sum_bet_money'] > 0){
        //            print_r($temp_result);
        //            print_r($result);
        //            exit;
        //        }

        // /* 追蹤用記錄，11 表示最終成立開獎號碼 */
        // $sql = 'INSERT INTO spsix_lottery_self_num(qishu, ball_1, ball_2, ball_3, ball_4, ball_5, ball_6, ball_7, sum_bet_money, sum_win, scale, userscale)
        // VALUES ('.$qishu.'11,'.$result['ball_1'].', '.$result['ball_2'].', '.$result['ball_3'].', '.$result['ball_4'].', '.$result['ball_5'].', '.$result['ball_6'].', '.$result['ball_7'].'
        // , '.$result['sum_bet_money'].', '.$result['sum_win'].', '.$result['scale'].', '.(1-$lottery_rate).')';
        // $db->createCommand($sql)->execute();

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
