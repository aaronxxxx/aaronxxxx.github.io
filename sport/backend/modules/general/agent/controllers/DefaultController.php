<?php

namespace app\modules\general\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\UserList;
use app\modules\general\admin\models\ManageLog;
use app\modules\general\finance\models\Money;
use app\modules\general\finance\models\MoneyLog;
use app\modules\general\member\models\Hacker;
use app\modules\general\sysmng\models\ar\SysConfig;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\AgentsTransferLog;
use app\modules\general\agent\models\AgentsMoney;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `FinanceModule` module
 */
class DefaultController extends BaseController
{
    public $layout = false;
    /**
     * 加款扣款頁面
     * @return string
     */
    public function actionIndex()
    {

        $user = array();
        $userName = $this->getParam('username','');
        if($userName){
            $user  = AgentsList::find()->where(array('agents_name'=>trim($userName)))->andWhere(['=','agent_level', 0])->all();

        }
        else{
            $user  = AgentsList::find()->where(['=','agent_level', 0])->all();
        }

        //今日加款扣款
        $addMinusMoney  = AgentsMoney::selectAddMinusMoney();
        return $this->render('index',array('user'=>$user,'addMinus'=>$addMinusMoney,'userName'=>$userName));
    }

    /**
     * 加款扣款操作
     * @return string
     */
    public function actionMoneySet()
    {
        $user = array();
        $type = $this->getParam('type','add');
        $userId = $this->getParam('uid','');
        if($userId){
            $user  = AgentsList::find()->where(array('id'=>trim($userId)))->andWhere(['=','agent_level', 0])->one();
        }
        return $this->render('moneyset',array(
            'user'=>$user,
            'type'=>$type
        ));
    }

    /**
     * 加款扣款數據操作
     */
    public function actionDoMoneySet(){
        
        $save = $this->getParam('save','');
        if($save && $save=='ok'){

            $uid = $this->getParam('user_id',0);
            $money = $this->getParam('money',0);
            $about = $this->getParam('about','');
            $userName = $this->getParam('user_name','');
            $money = floatval($money);
            $order = date("YmdHis")."_".$userName;
            $type = $this->getParam('type','');
                        
            $user  = AgentsList::find()->where(array('id'=>trim($uid)))->andWhere(['=','agent_level', 0])->one();
            
            $rows_check = ManageLog::find()
                ->select('edtime')
                ->where(['like','edlog','金額'])
                ->andWhere(['like','edlog',$userName])
                ->orderBy(['edtime'=>SORT_DESC])
                ->one();
            $time_diff = time()-strtotime($rows_check["edtime"]);            
            if($time_diff<20){
                return '操作失敗，不允許在20秒內對同一個帳號進行操作。(以目前操作時間開始計算)';
            }
            if($type=='add'){
                if(AgentsTransferLog::chongzhi($user['id'],$order,$money,$user['money'],$about."[總代存款]")){
                    AgentsMoney::chongzhi($user['id'],$order,$money,$user['money'],$about."[總代存款]");
                    return '加錢成功';
                }else{
                    return '加錢失敗';
                }
                return 'add';
            }else{
                return '操作異常，請重整後再試';
            }
        }

    }

    /**
     * 匯款管理
     * @return string
     */
    public function actionHuikuan()
    {
        //取得所有總代ID&名稱   新增代理時選擇所屬總代
        $agent_level = AgentsList::getAgentsAll(1);
        $agent_level = $agent_level->asArray()->all();

        $s_time = $this->getParam('s_time',date('Y-m-d 00:00:00', strtotime('-6 day')));
        $e_time = $this->getParam('e_time',date('Y-m-d 23:59:59'));
        $level = $this->getParam('agent_level');

        //今日加款扣款
        $addMinusMoney  = AgentsMoney::selectAddMinusMoney($s_time,$e_time,$level);
        return $this->render('huikuan',array('addMinus'=>$addMinusMoney,'s_time'=>$s_time,'e_time'=>$e_time,'agent_level'=>$agent_level));


    }

    /**
     * 財務日誌
     */
    public function actionFinanceLog(){
        $monthArray = array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
        $month = $this->getParam('date_month',0);
        $userIn = $this->getParam('userIn','');
        $userNin = $this->getParam('userNin','');
        $startTime = $this->getParam('s_time',date('Y-m-d 00:00:00', strtotime('-6 day')));
        $endTime = $this->getParam('e_time',date('Y-m-d 23:59:59'));
        $start = date('Y-m-d 00:00:00',strtotime($startTime));
        $end = date('Y-m-d 23:59:59',strtotime($endTime));
        $userInArray = $userIn ? explode(',',trim($userIn)):array();
        $userNinArray = $userNin ? explode(',',trim($userNin)):array();
        $list = Money::LogUser($userInArray,$userNinArray,$start,$end);
        $pageSize = SysConfig::getPagesize("money_show_row");
        $pages = new Pagination(['totalCount' =>$list->count(), 'pagesize' => $pageSize]);
        $data = $list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        if($data){
            $user = array();
            foreach ($data as $key=>$val){
                $user[] = $val['user_name'];
            }

            $huikuan =  Money::MoneyLog($userInArray,$userNinArray,$start,$end)->asArray()->all();
            $ckLog = Money::ckLog($user,$start,$end,0)->asArray()->all();
            $qkLog =  Money::qkLog($user,$start,$end,0)->asArray()->all();
            $ckLogHd = Money::ckLog($user,$start,$end,1)->asArray()->all();
            $qkLogHd =  Money::qkLog($user,$start,$end,1)->asArray()->all();
            foreach ($data as $key=>$val){
                $data[$key]['ck'] = 0;
                $data[$key]['qk'] = 0;
                $data[$key]['ckHd'] = 0;
                $data[$key]['qkHd'] = 0;
                $data[$key]['huikuan'] = 0;
                if($ckLog){
                    foreach ($ckLog as $ckey=>$ckval){
                        if($val['user_name']==$ckval['user_name']) {
                            $data[$key]['ck'] = $ckval['order_value'];
                        }
                    }
                }
                if($ckLogHd){
                    foreach ($ckLogHd as $cHkey=>$cHval){
                        if($val['user_name']==$cHval['user_name']) $data[$key]['ckHd'] = $cHval['order_value'];
                    }
                }
                if($qkLog){
                    foreach ($qkLog as $qkey=>$qkval){
                        if($val['user_name']==$qkval['user_name']) {
                            $data[$key]['qk'] = abs($qkval['order_value']);
                        }
                    }
                }
                if($qkLogHd){
                    foreach ($qkLogHd as $qHkey=>$qHval){
                        if($val['user_name']==$qHval['user_name']) $data[$key]['qkHd'] = $qHval['order_value'];
                    }
                }
                if($huikuan){
                    foreach ($huikuan as $hkey=>$hkval){
                        if($val['user_name']==$hkval['user_name']) {
                            $data[$key]['huikuan'] = $hkval['huikuan'];
                        }
                    }
                }
            }
        }
        return $this->render('financelog',array(
            'userIn'=>$userIn,
            'userNin'=>$userNin,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'monthArray'=>$monthArray,
            'month'=>$month,
            'data'=>$data,
            'pages'=>$pages
        ));
    }

}
