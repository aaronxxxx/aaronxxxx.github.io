<?php

namespace app\modules\general\mobile\controllers;

use app\modules\core\common\models\UserList;
use app\modules\general\member\models\ar\SysConfig;
use app\modules\general\member\models\TransactionLog\LiveUser;
use Yii;
use app\common\base\BaseController;

/**
 * 交易记录-真人投注记录
 * LiveController
 */
class LiveController extends BaseController {
    private $_req = null;
    private $_session = null;
    private $_params = null;

    public function init() {
        parent::init();

        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->getView()->title = '额度转换';
        $this->layout = 'member';
    }

    /**
     * 真人投注（额度转换）页面
     * @return string
     */
    public function actionIndex(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $data = [
            'user' => ['name' => '', 'money' => ''],
            'min_limit' => $this->_getMinimumChangeLimit()
        ];
        
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->render('index', $data);
        }

        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(['user_id' => $uid]);
        if (empty($user)) {
            return $this->render('index', $data);
        }
        
        $data['user'] = [
            'name' => $user['user_name'],
            'money' => $user['money'],
        ];
        
        return $this->render('index', $data);
    }
    
    public function actionUrl(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $getNews = Yii::$app->request->get();
        $type = $getNews['type'];
        if($type == 0){
            return $this->redirect('/?r=live/login/index&type=0');
        }elseif($type == 1){
            return $this->redirect('/?r=live/login/index&type=1');
        }elseif($type == 2){
            return $this->redirect('/?r=live/login/index&type=2');
        } elseif($type == 3){
            return $this->redirect('/?r=live/login/index&type=3');
        } elseif($type == 4){
            return $this->redirect('/?r=live/login/index&type=4');
        } elseif($type == 5){
            return $this->redirect('/?r=live/login/index&type=5');
        } elseif($type == 6){
            return $this->redirect('/?r=live/login/index&type=6');
        } elseif($type == 7){
            return $this->redirect('/?r=live/login/index&type=7');
        }elseif($type == 1002){
            return $this->redirect('/?r=game/login/index&type=1002');
        }else{
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("即将上线！敬请期待！");';
            echo '</script>';
        }
    }
    /**
     * 视讯直播记录
     * @return string
     */
    public function actionLive() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $arr['time1'] = date('Y-m-d');
        $arr['time2'] = date('Y-m-d', strtotime('-1 day'));
        $arr['time3'] = date('Y-m-d', strtotime('-2 day'));
        $arr['time4'] = date('Y-m-d', strtotime('-3 day'));
        $arr['time5'] = date('Y-m-d', strtotime('-4 day'));
        $arr['time6'] = date('Y-m-d', strtotime('-5 day'));
        $arr['time7'] = date('Y-m-d', strtotime('-6 day'));

        $live_today_result = LiveUser::getLiveBetMoneyAndCount(date("Y-m-d"), date("Y-m-d"), $user_group);
        $live_day1_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-1 day')), date('Y-m-d', strtotime('-1 day')), $user_group);
        $live_day2_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-2 day')), $user_group);
        $live_day3_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-3 day')), date('Y-m-d', strtotime('-3 day')), $user_group);
        $live_day4_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-4 day')), date('Y-m-d', strtotime('-4 day')), $user_group);
        $live_day5_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-5 day')), date('Y-m-d', strtotime('-5 day')), $user_group);
        $live_day6_result = LiveUser::getLiveBetMoneyAndCount(date('Y-m-d', strtotime('-6 day')), date('Y-m-d', strtotime('-6 day')), $user_group);
        
        $arr1['live_today_result'] = $live_today_result['bet_money_total'];
        $arr1['live_day1_result'] = $live_day1_result['bet_money_total'];
        $arr1['live_day2_result'] = $live_day2_result['bet_money_total'];
        $arr1['live_day3_result'] = $live_day3_result['bet_money_total'];
        $arr1['live_day4_result'] = $live_day4_result['bet_money_total'];
        $arr1['live_day5_result'] = $live_day5_result['bet_money_total'];
        $arr1['live_day6_result'] = $live_day6_result['bet_money_total'];

        $arr2['live_today_result'] = $live_today_result["val_money_total"];
        $arr2['live_day1_result'] = $live_day1_result["val_money_total"];
        $arr2['live_day2_result'] = $live_day2_result["val_money_total"];
        $arr2['live_day3_result'] = $live_day3_result["val_money_total"];
        $arr2['live_day4_result'] = $live_day4_result["val_money_total"];
        $arr2['live_day5_result'] = $live_day5_result["val_money_total"];
        $arr2['live_day6_result'] = $live_day6_result["val_money_total"];

        $arr3['live_today_result'] = $live_today_result["win_total"];
        $arr3['live_day1_result'] = $live_day1_result["win_total"];
        $arr3['live_day2_result'] = $live_day2_result["win_total"];
        $arr3['live_day3_result'] = $live_day3_result["win_total"];
        $arr3['live_day4_result'] = $live_day4_result["win_total"];
        $arr3['live_day5_result'] = $live_day5_result["win_total"];
        $arr3['live_day6_result'] = $live_day6_result["win_total"];


        $bet_money_total = $live_today_result["bet_money_total"] + $live_day1_result["bet_money_total"] + $live_day2_result["bet_money_total"] + $live_day3_result["bet_money_total"] + $live_day4_result["bet_money_total"] + $live_day5_result["bet_money_total"] + $live_day6_result["bet_money_total"];

        $val_money_total = $live_today_result["val_money_total"] + $live_day1_result["val_money_total"] + $live_day2_result["val_money_total"] + $live_day3_result["val_money_total"] + $live_day4_result["val_money_total"] + $live_day5_result["val_money_total"] + $live_day6_result["val_money_total"];

        $bet_win_total = $live_today_result["win_total"] + $live_day1_result["win_total"] + $live_day2_result["win_total"] + $live_day3_result["win_total"] + $live_day4_result["win_total"] + $live_day5_result["win_total"] + $live_day6_result["win_total"];

        $arr['bet_money_total'] = $bet_money_total;
        $arr['val_money_total'] = $val_money_total;
        $arr['bet_win_total'] = $bet_win_total;

        return $this->render('live', ['arr' => $arr, 'arr1' => $arr1, 'arr2' => $arr2, 'arr3' => $arr3]);
    }

    /**
     * 视讯直播记录详情
     */
    public function actionLiveDetail() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $arr['time'] = $getNews['time'];
        $start_time = $getNews['time'] . " 00:00:00";
        $start_time = date($start_time, strtotime("-12 hours"));
        $end_time = $getNews['time'] . " 23:59:59";
        $end_time = date($end_time, strtotime("-12 hours"));
        $arr['result'] = 1;
        $i = 1;
        $array = LiveUser::getLiveDetail($start_time, $end_time, $user_id);
        $data = $array[0];
        $page_list = $array[1];
        $arr2 = array();
        if ($data && count($data) > 0) {
            $arr['result'] = 0;
            $arrGameTypes = $this->_arrGameTypes();
            $arrPayTypes = $this->_arrPayTypes();
            foreach ($data as $key => $rows) {
                $rows['i'] = $i;
                if (!empty($arrGameTypes[$rows["live_type"]])) {
                    $rows["live_type"] = $arrGameTypes[$rows["live_type"]];
                }else{
                    $rows["live_type"]= $rows["live_type"];    
                }
                if (!empty($arrPayTypes[$rows["bet_info"]])) {
                    $rows["bet_info"] = $arrPayTypes[$rows["bet_info"]];
                }else{
                    $rows["bet_info"]= $rows["bet_info"];
                }
                $data[$key] = $rows;
                $i++;
            }
            $arr2 = $data;
        }
        return $this->render('liveDetail', ['arr' => $arr, 'arr2' => $arr2,'page_list'=>$page_list]);
    }
    /**
     * 游戏类型名字转换
     * @return type
     */
    public function _arrGameTypes() {
        return $arrGameTypes = Array(
            'BACCARAT' => '百家乐',
            'BACCARAT_INSURANCE' => '保险百家乐',
            'XOC_DIA' => '色碟',
            'DRAGON_TIGER' => '龙虎',
            'SICBO' => '骰宝',
            'ROULETTE' => '轮盘',
            'BAC' => '百家乐',
            'CBAC' => '包桌百家乐',
            'LINK' => '连环百家乐',
            'DT' => '龙虎',
            'SHB' => '骰宝',
            'ROU' => '轮盘',
            'FT' => '番摊',
            'SL1' => '巴西世界杯',
            'SL2' => '水果',
            'SL3' => '3D水族馆',
            'PK_J' => '杰克高手',
            'SL4' => '极速赛车',
            'PKBJ' => '新杰克高手',
            'LBAC' => '竞咪百家乐',
            'FRU' => '水果拉霸',
            'HUNTER' => '捕鱼王',
            'SLM1' => '美女沙排',
            'SLM2' => '运财羊',
            'SLM3' => '武圣传',
            'SC01' => '幸运老虎机',
            'TGLW' => '极速幸运轮',
            'SLM4' => '武则天',
            'TGCW' => '赌场战争',
            'SB01' => '太空漫游',
            'SB02' => '复古花园',
            'SB03' => '关东煮',
            'SB04' => '牧场咖啡',
            'SB05' => '甜一甜屋',
            'SB06' => '日本武士',
            'BK' => '篮球',
            'BS' => '棒球',
            'F1' => '其他',
            'FB' => '美足',
            'FT' => '足球',
            'FU' => '指数',
            'IH' => '冰球',
            'SP' => '冠军',
            'TN' => '网球',
            '3001' => '百家乐',
            '3002' => '二八杠',
            '3003' => '龙虎斗',
            '3005' => '三公',
            '3006' => '温州牌九',
            '3007' => '轮盘',
            '3008' => '骰宝',
            '3010' => '德州扑克',
            '3011' => '色碟',
            '3012' => '牛牛',
            '3014' => '无限21点',
            '5001' => '水果拉霸',
            '5002' => '扑克拉霸',
            '5003' => '筒子拉霸',
            '5004' => '足球拉霸',
            '5011' => '西游记',
            '5012' => '外星争霸',
            '5013' => '传统',
            '5014' => '丛林',
            '5015' => 'FIFA2010',
            '5016' => '史前丛林冒险',
            '5017' => '星际大战',
            '5018' => '齐天大圣',
            '5019' => '水果乐园',
            '5020' => '热带风情',
            '5021' => '7PK',
            '5022' => '怒火领空',
            '5023' => '7靶射击',
            '5024' => '2012欧锦赛',
            '5025' => '法海斗白蛇',
            '5026' => '2012伦敦奥运',
            '5027' => '功夫龙',
            '5028' => '中秋月光派对',
            '5029' => '圣诞派对',
            '5030' => '幸运财神',
            '5034' => '王牌5PK',
            '5035' => '加勒比扑克',
            '5039' => '魚蝦蟹',
            '5040' => '百搭二王',
            '5041' => '7PK',
            '5047' => '尸乐园',
            '5048' => '特务危机',
            '5049' => '玉蒲团',
            '5050' => '战火佳人',
            '5057' => '明星97',
            '5058' => '疯狂水果盘',
            '5059' => '马戏团',
            '5060' => '动物奇观五代',
            '5061' => '超级7',
            '5062' => '龙在囧途',
            '5070' => '黃金大轉輪',
            '5073' => '百家乐大转轮',
            '5074' => '钻石列车',
            '5075' => '圣兽传说',
            '5076' => '数字大转轮',
            '5077' => '水果大转轮',
            '5078' => '象棋大转轮',
            '5079' => '3D数字大转轮',
            '5080' => '乐透转轮',
            '5081' => '斗大',
            '5082' => '红狗',
            '5088' => '鬥大',
            '5091' => '三国拉霸',
            '5092' => '封神榜',
            '5093' => '金瓶梅',
            '5094' => '金瓶梅2',
            '5095' => '斗鸡',
            '5101' => '欧式轮盘',
            '5102' => '美式轮盘',
            '5103' => '彩金轮盘',
            '5104' => '法式轮盘',
            '5115' => '经典21点',
            '5116' => '西班牙21点',
            '5117' => '维加斯21点',
            '5118' => '奖金21点',
            '5131' => '皇家德州扑克',
            '5201' => '火焰山',
            '5202' => '月光宝盒',
            '5203' => '爱你一万年',
            '5204' => '2014FIFA',
            '5401' => '天山侠侣传',
            '5402' => '夜市人生',
            '5403' => '七剑传说',
            '5404' => '沙滩排球',
            '5405' => '暗器之王',
            '5701' => '连连看',
            '5801' => '海豚世界',
            '5802' => '阿基里斯',
            '5803' => '阿兹特克宝藏',
            '5804' => '大明星',
            '5805' => '凯萨帝国',
            '5806' => '奇幻花园',
            '5807' => '东方魅力',
            '5808' => '浪人武士',
            '5809' => '空战英豪',
            '5810' => '航海时代',
            '5811' => '狂欢夜',
            '5821' => '国际足球',
            '5822' => '兔女郎',
            '5823' => '发大财',
            '5824' => '恶龙传说',
            '5825' => '金莲',
            '5826' => '金矿工',
            '5827' => '老船长',
            '5828' => '霸王龙',
            '5831' => '高球之旅',
            '5832' => '高速卡车',
            '5833' => '沉默武士',
            '5834' => '异国之夜',
            '5835' => '喜福牛年',
            '5836' => '龙卷风',
            '5888' => 'JackPot',
            '5901' => '连环夺宝',
            '5902' => '糖果派对',
            '15006' => '3D玉蒲团',
            '15016' => '厨王争霸',
            '5089' => '红狗',
            '5084' => '圣兽传说',
            '15017' => '连环夺宝',
            '15018' => '激情243',
            '15019' => '倩女幽魂',
            '15020' => '欲望射手',
            '15021' => '全民狗仔',
            '15022' => '怒火领空 ',
            '15024' => '2014世足赛',
            '15026' => '环游世界',
            '15027' => '神舟27',
            'LT' => '六合彩',
            'D3' => '3D彩',
            'P3' => '排列三',
            'BT' => 'BB3D时时彩',
            'T3' => '上海时时彩',
            'CQ' => '重庆时时彩',
            'JX' => '江西时时彩',
            'TJ' => '极速时时彩',
            'GXSF' => '广西十分彩',
            'GDSF' => '广东十分彩',
            'TJSF' => '天津十分彩',
            'BJKN' => '北京快乐8',
            'CAKN' => '加拿大卑斯',
            'AUKN' => '澳洲首都商业区',
            'BBKN' => 'BB快乐彩',
            'BJPK' => '北京PK拾',
            'GDE5' => '广东11选5',
            'CQE5' => '重庆11选5',
            'JXE5' => '江西11选5',
            'SDE5' => '山东十一运夺金',
            'BBRB' => 'BB滚球王',
            'JSQ3' => '江苏快3',
            'AHQ3' => '安微快3',
            'BBBO' => 'BB宾果'
        );
    }
    /**
     * 投注类型名字转换
     * @return type
     */
    public function _arrPayTypes() {
        return $arrPayTypes = Array(
            'BC_BANKER' => '庄',
            'BC_BANKER_NC' => '庄免佣',
            'BC_PLAYER' => '闲',
            'BC_TIE' => '和',
            'BC_BANKER_PAIR' => '庄对',
            'BC_PLAYER_PAIR' => '闲对',
            'BC_BIG' => '大',
            'BC_SMALL' => '小',
            'BC_BANKER_INSURANCE' => '庄保险',
            'BC_PLAYER_INSURANCE' => '闲保险',
            1 => '庄',
            2 => '闲',
            3 => '和',
            4 => '庄对',
            5 => '闲对',
            6 => '大',
            7 => '小',
            8 => '散客区庄',
            9 => '散客区闲',
            11 => '庄(免佣)',
            21 => '龙',
            22 => '虎',
            23 => '和',
            41 => '大',
            42 => '小',
            43 => '单',
            44 => '双',
            45 => '全围',
            46 => '围1',
            47 => '围2',
            48 => '围3',
            49 => '围4',
            50 => '围5',
            51 => '围6',
            52 => '单点1',
            53 => '单点2',
            54 => '单点3',
            55 => '单点4',
            56 => '单点5',
            57 => '单点6',
            58 => '对子1',
            59 => '对子2',
            60 => '对子3',
            61 => '对子4',
            62 => '对子5',
            63 => '对子6',
            64 => '组合12',
            65 => '组合13',
            66 => '组合14',
            67 => '组合15',
            68 => '组合16',
            69 => '组合23',
            70 => '组合24',
            71 => '组合25',
            72 => '组合26',
            73 => '组合34',
            74 => '组合35',
            75 => '组合36',
            76 => '组合45',
            77 => '组合46',
            78 => '组合56',
            79 => '和值4',
            80 => '和值5',
            81 => '和值6',
            82 => '和值7',
            83 => '和值8',
            84 => '和值9',
            85 => '和值10',
            86 => '和值11',
            87 => '和值12',
            88 => '和值13',
            89 => '和值14',
            90 => '和值15',
            91 => '和值16',
            92 => '和值17',
            101 => '直接注',
            102 => '分注',
            103 => '街注',
            104 => '三数',
            105 => '角注',
            106 => '4个号码',
            107 => '列1',
            108 => '列2',
            109 => '列3',
            110 => '线注',
            111 => '打一',
            112 => '打二',
            113 => '打三',
            114 => '红',
            115 => '黑',
            116 => '大',
            117 => '小',
            118 => '单',
            119 => '双',
            130 => '1番',
            131 => '2番',
            132 => '3番',
            133 => '4番',
            134 => '1念2',
            135 => '1念3',
            136 => '1念4',
            137 => '2念1',
            138 => '2念3',
            139 => '2念4',
            140 => '3念1',
            141 => '3念2',
            142 => '3念4',
            143 => '4念1',
            144 => '4念2',
            145 => '4念3',
            146 => '角(1,2)',
            147 => '单',
            148 => '角(1,4)',
            149 => '角(2,3)',
            150 => '双',
            151 => '角(3,4)',
            152 => '1,2四通',
            153 => '1,2三通',
            154 => '1,3四通',
            155 => '1,3二通',
            156 => '1,4三通',
            157 => '1,4二通',
            158 => '2,3四通',
            159 => '2,3一通',
            160 => '2,4三通',
            161 => '2,4一通',
            162 => '3,4二通',
            163 => '3,4一通',
            164 => '三门(3,2,1)',
            165 => '三门(2,1,4)',
            166 => '三门(1,4,3)',
            167 => '三门(4,3,2)',
            'null' => '-',
            '' => '-'
        );
    }

    /* ============================ 华丽的分割线 =============================== */
    /**
     * 获取最小转账金额限制
     * @return int  限制值
     */
    private function _getMinimumChangeLimit() {
        $sys_config = SysConfig::find()->one();
        
        if (empty($sys_config)) {
            return 999999;
        }
        
        return (int)$sys_config['min_change_money'];
    }
}
