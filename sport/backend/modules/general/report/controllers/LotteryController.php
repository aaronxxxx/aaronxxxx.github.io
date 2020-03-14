<?php
namespace app\modules\general\report\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use app\modules\general\report\models\UserList;

class LotteryController extends BaseController {

    private $_resp = [];
    public $page = 20;

    public function init() {//初始化函数
        parent::init();
        $this->layout=false;
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失败
            'data' => [],
            'msg' => ''
        ];
    }

    /**
     * 彩票各个彩种报表
     * @return type
     */
    public function actionIndex() {
        ini_set('max_execution_time','0');
        $getDatas = Yii::$app->request->get();//获取前端参数
        if(!isset($getDatas['user_group'])){ $getDatas['user_group'] = '';}
        if(!isset($getDatas['user_ignore_group'])){ $getDatas['user_ignore_group'] = '';}
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        //获取用户名和忽略用户名查询到的用户id
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        if($userNames[0] == '' && $userIgnoreName[0] == ''){
            $s_time = $time['s_time'];
            $e_time = $time['e_time'];    
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id

            $userIds = UserList::find()->select('user_id')->where(['not in', 'user_id', $ExcludeGroup])->asArray()->all();      
            /*20180301@robin modify onlinetime >= '$s_time' => logintime >= '$s_time' AND　logintime <= '$e_time' 
            將登入時間規則拿掉
            */
        }else{
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            $userIds = UserList::getUserIdByUserName2($userNames,$userIgnoreName,$ExcludeGroup);

        }
        $ids = [];
        foreach ($userIds as $value) {
            array_unshift($ids,$value['user_id']);
        }
        $service = ServiceFactory::get('lottery', 'lotteryorderReportService');
        $lottery_list = $service->lottery($ids, $time['s_time'], $time['e_time']);
		
        return $this->render('index', [
                    'time' => $time,
                    'user_group' => $getDatas['user_group'],
                    'user_ignore_group' => $getDatas['user_ignore_group'],
                    'lottery_list' => $lottery_list[0],
                    ]
        );

    }

    /**
     * 查询个彩种下注信息
     */
    public function actionLotteryUser() {
        ini_set('max_execution_time','0');
        $getDatas = Yii::$app->request->get();//获取前端参数
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        //获取用户名和忽略用户名查询到的用户id
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        if($userNames[0] == '' && $userIgnoreName[0] == ''){
            $s_time = $time['s_time'];$e_time = $time['e_time'];
            //$userIds = UserList::find()->select('user_id')->where("onlinetime >= '$s_time' ")->asArray()->all();
            //修改會查詢會因onlinetime發生錯誤
            $userIds = UserList::find()->select('user_id')->asArray()->all();
        }else{
            $userIds = UserList::getUserIdByUserName2($userNames,$userIgnoreName);
        }
        $gtype = ArrayHelper::getValue($getDatas,'gtype', 'ALL_LOTTERY');
        $ids = [];
        foreach ($userIds as $value) {
            array_unshift($ids,$value['user_id']);
        }
        $pages = '';
        if(count($ids)>0){
            $fy = ArrayHelper::getValue($getDatas,'page', '1') - 1;
            $sum = $fy*$this->page;
            $offset = empty($sum) ? 0 : $sum;
            $service = ServiceFactory::get('lottery', 'lotteryorderReportService');
            $pages = new Pagination(['pageSize' => $this->page]);
            $lottery_list = $service->lotteryUser($gtype, $getDatas['s_time'], $getDatas['e_time'],$ids,$offset,$this->page);
            $pages->totalCount = $lottery_list['count'];
            $pages->getLimit($this->page);
        }else{
            $lottery_list = 0;
        }
        $getDatas['ggtype'] = $this->_typeToName($getDatas['gtype']);
        return $this->render('lotteryUser',[
            'lotteryData'=>$lottery_list['data'],
            'getDatas'=>$getDatas,
            't_allmoney'=>$lottery_list['allmoney'],
            't_sy'=>$lottery_list['win_total'],
            'he'=>$lottery_list['bet_he'],
            'pages'=>$pages,
        ]);
    }

    /**
     * 名称装换
     * @param type $type
     * @return string
     */
    function _typeToName($type) {
        $name = '';
        if ($type == 'D3')
            $name = '3D彩';
        if ($type == 'P3')
            $name = '排列三';
        if ($type == 'T3')
            $name = '上海时时乐';
        if ($type == 'CQ')
            $name = '重庆时时彩';
        if ($type == 'TJ')
            $name = '极速时时彩';
        if ($type == 'GXSF')
            $name = '广西十分彩';
        if ($type == 'GDSF')
            $name = '广东十分彩';
        if ($type == 'TJSF')
            $name = '天津十分彩';
        if ($type == 'CQSF')
            $name = '重庆十分彩';
        if ($type == 'BJKN')
            $name = '北京快乐8';
        if ($type == 'GD11')
            $name = '广东十一选五';
        if ($type == 'BJPK')
            $name = '北京PK拾';
        if ($type == 'SSRC')
            $name = '极速赛车';
        if ($type == 'MLAFT')
            $name = '幸运飞艇';
        return $name;
    }
}
