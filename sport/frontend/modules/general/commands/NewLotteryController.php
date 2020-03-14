<?php
/*
 * @Description: 建立极速赛车(SSRC/ssrc)
 * @Author: ar-yen
 * @Date: 2019-02-12 14:15:48
 * @LastEditTime: 2019-02-14 15:25:22
 * @LastEditors: Please set LastEditors
 */

namespace app\modules\general\commands;
error_reporting(0);
use Yii;
use yii\console\Controller;


class NewLotteryController extends Controller
{
    public static function actionIndex()
    {
        $lottery_name='极速赛车';                        //彩票使用的名称
        $lottery_type='ssrc';                          //彩票使用的代號
        $lottery_result_table = 'lottery_result_ssrc'; //開獎用table
        $kaipan_time = '2018-01-01 10:00:00';           //開盤時間
        $fenpan_time = '2018-01-01 10:01:15';           //封盤時間
        $kaijiang_time = '2018-01-01 10:01:30';         //開獎時間
        $count = 720;
        $idcount = 2300;
        // 1. Create儲存開獎用的table
         //self::BuildLotteryResult($lottery_result_table);
        // 2. Insert web_close 两笔是否開啟,校正
         //self::BuildLotteryWebClose($lottery_type,$lottery_name);
        // 3. Insert Lottert_schedule 排程
         //self::BuildLotterySchedule($count,$idcount,$kaipan_time,$fenpan_time,$kaijiang_time,$lottery_type,$lottery_name);
        // 4. Insert user_group 新增欄位
         //self::BuildUserGroup();
        // 5. Insert odds_lottery
        // self::BuildOddsLottery();
    }

    /**
     * @description: 新增OddsLottery的欄位
     * @param 
     * @return: 
     */
     public static function BuildOddsLottery()
     {
        $sql = "INSERT INTO `odds_lottery` VALUES ('456', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('457', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('458', '幸运飞艇', '主盤勢', 'ball_1', '1.96', '1.95', '1.95', '1.95', '1.90', '1.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('459', '幸运飞艇', '主盤勢', 'ball_2', '1.95', '1.95', '1.95', '1.95', '1.90', '1.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('460', '幸运飞艇', '主盤勢', 'ball_3', '1.95', '1.95', '1.95', '1.95', '1.90', '1.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('461', '幸运飞艇', '主盤勢', 'ball_4', '1.95', '1.95', '1.95', '1.95', '1.90', '1.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('462', '幸运飞艇', '主盤勢', 'ball_5', '1.95', '1.95', '1.95', '1.95', '1.90', '1.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('463', '幸运飞艇', '主盤勢', 'ball_6', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('465', '幸运飞艇', '主盤勢', 'ball_7', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('466', '幸运飞艇', '主盤勢', 'ball_8', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('467', '幸运飞艇', '主盤勢', 'ball_9', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('468', '幸运飞艇', '主盤勢', 'ball_10', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('469', '幸运飞艇', '定位', 'ball_1', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('470', '幸运飞艇', '定位', 'ball_2', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('471', '幸运飞艇', '定位', 'ball_3', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('472', '幸运飞艇', '定位', 'ball_4', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('473', '幸运飞艇', '定位', 'ball_5', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('474', '幸运飞艇', '定位', 'ball_6', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('475', '幸运飞艇', '定位', 'ball_7', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('476', '幸运飞艇', '定位', 'ball_8', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('477', '幸运飞艇', '定位', 'ball_9', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('478', '幸运飞艇', '定位', 'ball_10', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', '9.60', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        INSERT INTO `odds_lottery` VALUES ('479', '幸运飞艇', '冠亞軍和-快速', 'ball_1', '41.50', '41.50', '20.50', '20.50', '13.50', '13.50', '10.00', '10.00', '8.50', '10.00', '10.00', '13.50', '13.50', '20.50', '20.50', '41.50', '41.50', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
        ";
        $db = Yii::$app->db;
        $db->createCommand($sql)->execute();
     }

    /**
     * @description: 新增User_group的欄位
     * @param {type,name}{'mlaft','幸运飞艇'} 
     * @return: 
     */
    public static function BuildUserGroup($lottery_type,$lottery_name)
    {
        $db = Yii::$app->db;
        $sql = "ALTER TABLE `user_group`
        ADD COLUMN `mlaft_max_bet`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '飛艇最大下注' AFTER `ssrc_bet_reb`,
        ADD COLUMN `mlaft_lower_bet`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '飛艇最低下注' AFTER `mlaft_max_bet`,
        ADD COLUMN `mlaft_bet`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '飛艇' AFTER `mlaft_lower_bet`,
        ADD COLUMN `mlaft_bet_reb`  decimal(4,3) NOT NULL DEFAULT 0.000 AFTER `mlaft_bet`;";
        $db->createCommand($sql)->execute();
        
        //$sql_jia = "INSERT INTO `web_close` (`sign`,`close`,`name`,`end_close_time`,`des`,`is_jiaodui`,`qishu`,`kaijiang_time`) VALUES ('".$lottery_type."_jia', '1', '".$lottery_name."校对', null, '', '1', '729392', '2019-02-11 09:30:00');"; 
        // $db->createCommand($sql_jia)->execute();
    }


    /**
     * @description: 新增web_close的兩筆紀錄
     * @param {type,name}{'mlaft','幸运飞艇'} 
     * @return: 
     */
    public static function BuildLotteryWebClose($lottery_type,$lottery_name)
    {
        $db = Yii::$app->db;
        $sql = "INSERT INTO `web_close` (`sign`,`close`,`name`,`end_close_time`,`des`,`is_jiaodui`,`qishu`,`kaijiang_time`) VALUES ('".$lottery_type."', '1', '".$lottery_name."', null, '', '0', null, null);";
        $db->createCommand($sql)->execute();
        
        //$sql_jia = "INSERT INTO `web_close` (`sign`,`close`,`name`,`end_close_time`,`des`,`is_jiaodui`,`qishu`,`kaijiang_time`) VALUES ('".$lottery_type."_jia', '1', '".$lottery_name."校对', null, '', '1', '729392', '2019-02-11 09:30:00');"; 
        // $db->createCommand($sql_jia)->execute();
    }

    /**
     * @description: 新增lottery_schedule的兩筆紀錄
     * @param {type,name}{'mlaft','幸运飞艇'}
     * @return: 
     */
    public static function BuildLotterySchedule($count,$idcount,$kaipan,$fenpan,$kaijiang,$type,$name)
    {
        $fieldArray = array('id','lottery_type','qishu','kaipan_time','fenpan_time','kaijiang_time','state','type');//欄位名稱
        $valueArray = array();//value暫存陣列
        $use_table = 'lottery_schedule';    //表名

        $lottery_type = $name;
        $kaipan_time = $kaipan;
        $fenpan_time = $fenpan;
        $kaijiang_time = $kaijiang;
        $state = '';
        $type = $type;
        for($i = 1;$i<=$count;$i++)
        {
            $valueArray[$i][] = $i+$idcount;   //lottery_type + 目前id,此表id沒有累加
            $valueArray[$i][] = $lottery_type;   //lottery_type
            $valueArray[$i][] = $i;              //quish
            $valueArray[$i][] = substr($kaipan_time, -8);   //kaipan_time
            $valueArray[$i][] = substr($fenpan_time,-8);   //fenpan_time
            $valueArray[$i][] = substr($kaijiang_time,-8);   //kaijiang_time
            $valueArray[$i][] = $state;   //state
            $valueArray[$i][] = $type;   //type
            // 三個時間遞增
            $kaipan_time = (string)date("Y-m-d H:i:s",strtotime($kaipan_time."+90 sec"));
            $fenpan_time = (string)date("Y-m-d H:i:s",strtotime($fenpan_time."+90 sec"));
            $kaijiang_time = (string)date("Y-m-d H:i:s",strtotime($kaijiang_time."+90 sec"));
        }
        $db = Yii::$app->db;
        $sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
        //Update lottery_schedule set lottery_type = '極速賽車' where lottery_type = 'SSRC'  //避免中文亂碼,自行執行SQL
        //delete from lottery_schedule where lottery_type = '極速賽車'                       //假如出錯刪除sql
        $update_rule = ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)';
        $db->createCommand($sql.$update_rule)->execute();
    }

    /**
     * @description: 新增資料庫開獎table
     */
     public static function BuildLotteryResult($lottery_result_table)
     {
        $sql = "SET FOREIGN_KEY_CHECKS=0;";
        $sql .= "DROP TABLE IF EXISTS `".$lottery_result_table."`;";
        $sql .= "CREATE TABLE `".$lottery_result_table."` (
            `id` bigint(22) NOT NULL AUTO_INCREMENT,
            `qishu` varchar(255) NOT NULL,
            `create_time` datetime NOT NULL,
            `datetime` datetime DEFAULT NULL,
            `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
            `prev_text` varchar(2000) DEFAULT NULL,
            `ball_1` int(2) DEFAULT NULL,
            `ball_2` int(2) DEFAULT NULL,
            `ball_3` int(2) DEFAULT NULL,
            `ball_4` int(2) DEFAULT NULL,
            `ball_5` int(2) DEFAULT NULL,
            `ball_6` int(2) DEFAULT NULL,
            `ball_7` int(2) DEFAULT NULL,
            `ball_8` int(2) DEFAULT NULL,
            `ball_9` int(2) DEFAULT NULL,
            `ball_10` int(2) DEFAULT NULL,
            `from_url` varchar(200) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `qishu` (`qishu`)
          ) ENGINE=InnoDB AUTO_INCREMENT=3009486 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;";
        $db = Yii::$app->db;
        $db->createCommand($sql)->execute();
     }
}
