<?php

namespace app\modules\general\report\controllers;

use app\modules\general\report\models\UserList;
use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use yii\helpers\ArrayHelper;

/*
 * 六合彩赔率控制器
 */

class StatementController extends BaseController {

    public $layout = '@app/views/layouts/main2.php';
    public $status = array();
    public $animal = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
    public $statu = array(0 => '未结算', 1 => '已结算', 2 => '重新结算', 3 => '已作废', '0,1,2,3' => '全部注单');
    public $page = 20;
    public function init() {//初始化函数
        $this->layout=false;
        parent::init();
    }

    /*
     * 六合彩明细
     */

    public function actionSixDetail() {
        ini_set('max_execution_time','0');
        $monthArray = array('选择月份', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
        $getDatas = Yii::$app->request->get();//获取前端参数
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_in'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_nin'),","));
        //获取用户名和忽略用户名查询到的用户id
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        $group = ArrayHelper::getValue($getDatas,'group', '');
        if($userNames[0] == '' && $userIgnoreName[0] == ''){
            $s_time = $time['s_time'];$e_time = $time['e_time'];
            //$userIds = UserList::find()->select('user_id')->where("onlinetime >= '$s_time' ")->asArray()->all();
            //修改會查詢會因onlinetime發生錯誤
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id

            $userIds = UserList::find()->select('user_id')->where(['not in', 'user_id', $ExcludeGroup])->asArray()->all();
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
        $fy = ArrayHelper::getValue($getDatas,'page', '1') - 1;
        $sum = $fy*$this->page;
        $offset = empty($sum) ? 0 : $sum;
        $pages = new Pagination(['pageSize' => $this->page]);
        $service = ServiceFactory::get('six', 'sixReportService');
        $six_result = $service->sixDetail($ids,$time['s_time'], $time['e_time'],$offset,$this->page);
        $pages->totalCount = $six_result['count'];
        $pages->getLimit($this->page);

        return $this->render('sixdetail', array(
                    'data' => $six_result['data'],
                    'time'=>$time,
                    'getDatas' => $getDatas,
                    'monthArray' => $monthArray,
                    'group' => $group,
                    'status' => $this->statu,
                    'draw'  => 0,
        ));
    }

    public function actionSixDetailUser() {
        ini_set('max_execution_time','0');
        $monthArray = array('选择月份', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
        $getDatas = Yii::$app->request->get();//获取前端参数
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_in'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_nin'),","));
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
        $group = ArrayHelper::getValue($getDatas,'group', '');
        $ids = [];
        foreach ($userIds as $value) {
            array_unshift($ids,$value['user_id']);
        }
        $fy = ArrayHelper::getValue($getDatas,'page', '1') - 1;
        $sum = $fy*$this->page;
        $offset = empty($sum) ? 0 : $sum;
        $pages = new Pagination(['pageSize' => $this->page]);
        $service = ServiceFactory::get('six', 'sixReportService');
        $six_result = $service->sixDetailUser($ids,$time['s_time'], $time['e_time'],$offset,$this->page);
        $pages->totalCount = $six_result['count'];
        $pages->getLimit($this->page);
        return $this->render('sixdetailuser', array(
            'data' => $six_result['data'],
            'time'=>$time,
            'getDatas' => $getDatas,
            'monthArray' => $monthArray,
            'group' => $group,
            'status' => $this->statu,
            'pages' => $pages,
            'draw'  => 0,
        ));
    }

    public function actionSixDetailNum() {
        ini_set('max_execution_time','0');
        $monthArray = array('选择月份', '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
        $getDatas = Yii::$app->request->get();//获取前端参数
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_in'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_nin'),","));
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
        $group = ArrayHelper::getValue($getDatas,'group', '');
        $ids = [];
        foreach ($userIds as $value) {
            array_unshift($ids,$value['user_id']);
        }
        $fy = ArrayHelper::getValue($getDatas,'page', '1') - 1;
        $sum = $fy*$this->page;
        $offset = empty($sum) ? 0 : $sum;
        $pages = new Pagination(['pageSize' => $this->page]);
        $service = ServiceFactory::get('six', 'sixReportService');
        $six_result = $service->sixDetailNum($ids,$time['s_time'], $time['e_time'],$offset,$this->page);
        $pages->totalCount = $six_result['count'];
        $pages->getLimit($this->page);
        return $this->render('sixdetailnum', array(
            'data' => $six_result['data'],
            'time'=>$time,
            'getDatas' => $getDatas,
            'monthArray' => $monthArray,
            'group' => $group,
            'status' => $this->statu,
            'pages' => $pages,
            'draw'  => 0,
        ));
    }

}
