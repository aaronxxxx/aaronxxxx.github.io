<?php
namespace app\modules\general\finance\models;

use app\modules\core\common\models\UserList;
use Yii;
use yii\db\ActiveRecord;

/**
 * 资金操作
 */
class Money extends ActiveRecord{
    /*
     * 后台充值
     * @$uid   用户ID
     * @$order  单号
     * @$money  操作金额
     * @$assets  操作前用户金额
     * @$about  操作理由
     */
    public static function chongzhi($uid, $order, $money, $assets,$about = '')
    {
        $moneyModel = new Money();
        $moneyModel->user_id = $uid;
        $moneyModel->order_value = $money;
        $moneyModel->status = '成功';
        $moneyModel->order_num = $order;
        $moneyModel->about = $about;
        $moneyModel->assets = $assets;
        $moneyModel->balance = $assets+$money;
        $moneyModel->type = '后台充值';
        $moneyModel->update_time = date('Y-m-d H:i:s');
        $result = $moneyModel->save();
        return $result;
    }
    /*
     * 后台提现
     * @$uid   用户ID
     * @$order  单号
     * @$money  操作金额
     * @$assets  操作前用户金额
     * @$about  操作理由
     */
    public static function tixian($uid,$order, $money, $assets, $about = '')
    {
        $moneyModel = new Money();
        $moneyModel->user_id = $uid;
        $moneyModel->order_value = 0-$money;
        $moneyModel->status = '成功';
        $moneyModel->order_num = $order;
        $moneyModel->about = $about;
        $moneyModel->assets = $assets;
        $moneyModel->balance = ($assets-$money)<=0 ? 0:$assets-$money;
        $moneyModel->type = '后台扣款';
        $moneyModel->update_time = date('Y-m-d H:i:s');
        $result = $moneyModel->save();
        return $result;
    }

    /*
     * 资金操作用户组
     * $userIn  查询的用户
     * $userNin  忽略的用户
     * $startTime  开始时间
     * $endTime    结束时间
     */
    public static function LogUser($userIn,$userNin,$startTime,$endTime){
        $list = Money::find()
            ->select(array("u.user_id","u.user_name"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id");
        if(!empty($userIn)){
            $list->andWhere(array('in','u.user_name',$userIn));
        }
        if(!empty($userNin)){
            $list->andWhere(array('not in','u.user_name',$userNin));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->groupBy(array('u.user_id'));
        return $list;
    }

    /*
     * 汇款资金日志(不包括活动资金)
     * $userIn  查询的用户
     * $userNin  忽略的用户
     * $startTime  开始时间
     * $endTime    结束时间
     */
    public static function MoneyLog($userIn,$userNin,$startTime,$endTime){
        $list = Money::find()
            ->select(array("SUM(m.order_value) AS huikuan","u.user_id","u.user_name"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id")
            ->where(array('m.type'=>'银行汇款','m.status'=>'成功'))
            ->andWhere(array('not like','m.about', '用于活动'));
        if(!empty($userIn)){
            $list->andWhere(array('in','u.user_name',$userIn));
        }
        if(!empty($userNin)){
            $list->andWhere(array('not in','u.user_name',$userNin));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->groupBy(array('u.user_id'))->orderBy(array('huikuan' => SORT_DESC));

        return $list;
    }

    /*
     * 存款资金日志
     * $user  查询的用户
     * $startTime  开始时间
     * $endTime    结束时间
     * $type       是否用于活动（1：是，0：否）
     */
    public static function ckLog($user,$startTime,$endTime,$type){
        $list = Money::find()
            ->select(array("SUM(m.order_value) AS order_value","u.user_id","u.user_name"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id")
            ->where(array('m.status'=>'成功'))
            ->andWhere(['or','m.type=:typeO','m.type=:typeT'], [':typeO' => '在线支付',':typeT' => '后台充值']);
        if($type==1){
            $list->andWhere(array('like','m.about', '用于活动'));
        }else{
            $list->andWhere(array('not like','m.about', '用于活动'));
        }

        if($user){
            $list->andWhere(array('in','user_name',$user));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        
        $list->groupBy(array('u.user_id'))->orderBy(array('order_value' => SORT_DESC));

        return $list;
    }
    /*
     * 取款资金日志
     * $user  查询的用户
     * $startTime  开始时间
     * $endTime    结束时间
     * $type       是否用于活动（1：是，0：否）
     */
    public static function qkLog($user,$startTime,$endTime,$type){
        $list = Money::find()
            ->select(array("SUM(m.order_value) AS order_value","u.user_id","u.user_name"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id")
            ->where('m.order_value < :order_value',[':order_value'=>0])
            ->andWhere(array('m.status'=>'成功'));
            if($type==1){
                $list->andWhere(array('like','m.about', '用于活动'));
            }else{
                $list->andWhere(array('not like','m.about', '用于活动'));
            }
        if($user){
            $list->andWhere(array('in','user_name',$user));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->groupBy(array('u.user_id'))->orderBy(array('order_value' => SORT_DESC));
        return $list;
    }

    /*
     * 汇款明细
     * $user  查询的用户
     * $startTime  开始时间
     * $endTime    结束时间
     * $order      排序字段
     * $status     状态
     * $bank       操作银行
     */
    public static function huikuan($user,$startTime,$endTime,$order,$status,$bank){
        $list = Money::find()
            ->select(array("m.*","u.user_id","u.user_name"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id")
            ->where(array('m.type'=>'银行汇款'));
        $list->andWhere('m.order_value > :money',[':money'=>0]);
        if($user){
            $list->andWhere(array('user_name'=>$user));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        if($status!='全部'){
            if($status=='未结算'){
                $list->andWhere(['or','m.status=:statusO','m.status=:statusT'], [':statusO' => '未结算',':statusT' => '审核中']);
            }else{
                $list->andWhere(array('m.status'=>$status));
            }
        }
        if($bank){
            $list->andWhere(array('pay_card'=>$bank));
        }
        $list->orderBy(array($order => SORT_DESC));
        return $list;
    }

    /*
    * 订单明细
    * $id  查询的订单ID
    */
    public static function moneyDetail($id){
        $list = Money::find()
            ->select(array("m.*","u.user_id","u.user_name","u.pay_name","u.remark"))
            ->from("money as m")
            ->innerJoin("user_list as u","m.user_id=u.user_id")
            ->where(array('m.id'=>$id))->asArray()->one();
        return $list;
    }
    
    /*
    * 订单修改
    * $id  查询的订单ID
    * $status 操作状态
    * $sxfBl  赠送金额
    */
    public static function updateMoney($id,$status,$sxfBl){
        $huikuan = Money::findOne(array('id'=>$id));
        //汇款失败操作
        if($status==2){
            if(!$huikuan || ($huikuan->status!='未结算' && $huikuan->status!='审核中')){
                return '此汇款单已操作完成，不能做失败处理！';
            }
            if($huikuan->status=='失败') return '已经是汇款失败状态了';
            if($huikuan->status=='成功') return '已经是汇款成功状态了';
            $huikuan->status = '失败';
            $huikuan->balance = $huikuan->assets;
            return $huikuan->save() ? '操作成功':'操作失败';
        }
        if(!$huikuan) return '找不到要操作的汇款单';
        //汇款成功
        if($status==1){
            if($huikuan->status=='成功') return '已经加过款了，请不要重复加';
            $orderMoney = $huikuan->order_value;
            $userId = $huikuan->user_id;
            $orderNum = $huikuan->order_num;
            $user = UserList::findOne(array('user_id'=>$userId));
            if(!$user) return "找不到您要操作的用户!";
            $zsjr = floor($orderMoney * $sxfBl) * 1;
            $userMoney = $user->money;
            //修改用户金额
            $user->money = $user->money+$orderMoney+$zsjr;
            $resultUser = $user->save();
            //修改汇款单
            $huikuan->status = '成功';
            $huikuan->zsjr = $zsjr;
            $huikuan->balance = $userMoney+$orderMoney+$zsjr;
            $resultHuikuan = $huikuan->save();
            if(!$resultUser && $resultHuikuan){
                return '更新金额失败';
            }
            $moneyLog = new MoneyLog();
            $moneyLog->user_id = $userId;
            $moneyLog->order_num = $orderNum;
            $moneyLog->about = '';
            $moneyLog->update_time = date('Y-m-d H:i:s');
            $moneyLog->type = '用户汇款成功';
            $moneyLog->order_value = $orderMoney+$zsjr;
            $moneyLog->assets = $userMoney;
            $moneyLog->balance =  $userMoney+$orderMoney+$zsjr;
            if(!$moneyLog->save()){
                $huikuan = Money::findOne(array('id'=>$id,'status'=>'成功'));
                $user = UserList::findOne(array('user_id'=>$userId));
                if($huikuan && $user){
                    $orderValue = $huikuan->order_value;
                    $userMoney = $user->money;
                    //修改汇款单
                    $huikuan->status = '未结算';
                    $huikuan->update_time = date('Y-m-d H:i:s');
                    $huikuan->about = "";
                    $huikuan->balance = $userMoney-$orderValue;
                    $huikuan->save();
                    $user->money = $userMoney-$orderValue;
                    $user->save();
                    return '插入金钱记录失败，操作失败';
                }
                return "找不到您要操作的用户或汇款单!";
            }
            return '操作成功';
        }
        //汇款审核中
        if($status==3){
            if($huikuan->status=='审核中') return '已经是审核中了';
            if($huikuan->status=='成功') return '已经加过款了，请不要重复加';   //确认成功付款后,禁止在加钱
            $huikuan->status = '审核中';
            $huikuan->balance = $huikuan->assets;
            return $huikuan->save() ? '操作成功':'操作失败';
        }
    }

 /**
     *  查询存款数据的id;
     * @param type $status
     * @param type $username
     * @param type $time_start
     * @param type $time_end
     * @param type $order
     * @return type
     */
    public static function selectCunkuanId($status,$username,$time_start,$time_end,$order){
        $id = Money::find()
                ->select(["id"])
                ->where([">=","order_value",0])
                ->andWhere(["or",["type"=>"在线支付"],["type"=>"后台充值"]]);
        if($status){
            if($status != "全部存款" && $status != "未结算"){
                $id = $id->andWhere(["status"=>$status]);
            }
            if($status == "未结算"){
                $id = $id->andWhere(["or",["status"=>"未结算"],["status"=>"审核中"]]);
            }
            if($status == "在线支付"){
                $id = Money::find()
                         ->select(["id"])
                         ->where([">=","order_value","0"])
                         ->andWhere(["status"=>"成功"])
                         ->andWhere(["type"=>"在线支付"]);
            }
            if($status == "后台充值"){
                $id = Money::find()
                         ->select(["id"])
                         ->where([">=","order_value","0"])
                         ->andWhere(["type"=>"后台充值"]);
            }
        }
        if($username){
            $id = $id->andWhere(["like","order_num",$username]);
        }
        if($time_start){
            $stime = $time_start." 00:00:00";
            $id = $id->andWhere([">=","update_time",$stime]);
        }
        if($time_end){
            $etime = $time_end." 23:59:59";
            $id = $id->andWhere(["<=","update_time",$etime]);
        }
        $id = $id->orderBy([$order=>SORT_DESC]);
//                ->asArray()
//                ->all();
        return $id;
    }
    
    /**
     * 查询存款管理的数据并分页
     */
    public static function selectCunkuanData($mid,$order){
        $data = Money::find()
                ->where(["id"=>$mid])
                ->orderBy([$order=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
    }
    
    /**
     * 查询财务信息
     * @param type $time_start
     * @param type $time_end
     * @param type $username
     * @param type $status
     * @return type
     */
    public static function selectCaiwuData($time_start,$time_end,$username,$status){
        $data = Money::find()
                ->select("m.id,m.status,m.order_value,m.order_num,m.update_time,m.about,m.id,m.assets,m.balance,m.type,m.user_id")
                ->from("money as m")
                ->innerJoin('user_list as u', 'm.user_id=u.user_id')
                ->where(["or", ["m.type" => "在线支付"], ["m.type" => "用户提款"], ["m.type" => "后台充值"], ["m.type" => "后台扣款"], ["m.type" => "银行汇款"]]); //所有该会员的存款取款记录
        if ($time_start) {
            $stime = $time_start . ' 00:00:00';
            $data = $data->andWhere([">=","m.update_time",$stime]);
        }
        if ($time_end) {
            $etime = $time_end . ' 23:59:59';
            $data = $data->andWhere(["<=","m.update_time",$etime]);
        }
        if ($username){
             $data = $data->andWhere(["u.user_name"=>$username]);
        }
        if($status!="所有状态" && $status!="未结算"){
            $data = $data->andWhere(["m.status"=>$status]);
        }
        if ($status == "未结算") {
            $data = $data->andWhere(["or",["m.status"=>"未结算"],["m.status"=>"审核中"]]);
        }
        $data->orderBy(array('m.update_time'=>SORT_DESC));
        return $data;
    }
    
    /**
     * 查询财务信息
     */
    public static function selectCaiwuData1($time_start,$time_end,$username,$status){
         $data = (new \yii\db\Query())
                ->select("m.id,m.status,m.order_value,m.order_num,m.update_time,m.id,m.assets,m.balance,m.pay_card")
                ->from("money as m")
                ->leftJoin('user_list as u', 'm.user_id=u.user_id')
                ->where(["m.type" => "银行汇款"]); //所有该会员的存款取款记录
         if ($time_start) {
            $stime = $time_start . ' 00:00:00';
            $data = $data->andWhere([">=","m.update_time",$stime]);
        }
        if ($time_end) {
            $etime = $time_end . ' 23:59:59';
            $data = $data->andWhere(["<=","m.update_time",$etime]);
        }
        if ($username){
             $data = $data->andWhere(["u.user_name"=>$username]);
        }
        if($status!="所有状态"){
            $data = $data->andWhere(["m.status"=>$status]);
        }
        $data = $data->all();
        return $data;
    }

   
    
    
    
  public static function selectCk($mid){
        $data = Money::find()
                ->select("user_list.user_id,money.order_num,money.order_value,user_list.money as assets")
                ->leftJoin("user_list","money.user_id=user_list.user_id")
                ->andWhere("money.id=:mid",[':mid'=>$mid])
                ->asArray()
                ->one();
        return $data;
    }
    
    /**
     * 更新ck数据
     * @param type $mid
     * @return type
     */
    public static function updateCkSuccess($mid){
         $sql = "update money,user_list set money.status='成功',money.update_time=now(),user_list.money=user_list.money+money.order_value,"
                 . "money.about='该订单手工操作成功',"
                 . "money.sxf=money.order_value/100,money.balance=user_list.money+money.order_value "
                 . "where money.user_id=user_list.user_id and money.id='$mid' and money.`status`='未结算'";
         $r = Yii::$app->db
                ->createCommand($sql)
                ->execute();
         return $r;
    }
    
    /**
     * 更新状态
     * @param type $mid
     * @return type
     */
    public static function updateCkStatus($mid){
        $sql = "update money,user_list set money.status='未结算',money.update_time=now(),user_list.money="
                . "user_list.money-money.order_value,money.about='该订单手工操作失败',money.sxf=money.order_value/100,"
                . "money.balance=user_list.money-money.order_value where money.user_id=user_list.user_id and money.id='$mid'"
                . " and money.`status`='成功'";
        $r = Yii::$app->db
                ->createCommand($sql)
                ->execute();
         return $r;
    }
    
    /**
     * 更新存款失败数据
     */
    public static function updateCkFalse($mid){
        $r = 0;
        $money = Money::find()->where(['id'=>$mid])->andWhere(['status'=>'未结算'])->one();
        if($money){
            $money->status = '失败';
            $money->about = '该订单手工操作失败';
            $money->balance = $money->assets;
            $r = $money->save();
        }
        return $r;
    }

    /**
     * 查询提款列表id
     * @param type $status 状态全部提款；未处理；提款失败；提款成功
     * @param type $username  用户名
     * @param type $time_start
     * @param type $time_end
     * @return type
     */
    public static function selectTikuanId($status,$username,$time_start,$time_end,$order){
        $id = Money::find()
                ->select(["id"])
                ->where(['<','order_value',0]);
        if($status){
            if($status != "全部提款" && $status != "未结算"){
                $id = $id->andWhere('status=:status',[':status'=>$status]);
            }
            if($status == "未结算"){
                $id = $id->andWhere(['or',['status'=>'未结算'],['status'=>'审核中']]);
            }
        }
        if($username){
            $id = $id->andWhere(['like','order_num',  trim($username)]);
        }
        if($time_start){
            $id = $id->andWhere(['>=','update_time',$time_start.' 00:00:00']);
        }
        if($time_end){
            $id = $id->andWhere(['<=','update_time',$time_end.' 23:59:59']);
        }
        if($order){
            if($order=='order_value'){
                $id = $id->orderBy([$order=>SORT_ASC]);
            }else{
                 $id = $id->orderBy([$order=>SORT_DESC]);
            }
        }else{
            $id = $id->orderBy(['id'=>SORT_DESC]);
        }
        return $id;
    }
    
    /**
     * 查询提现信息
     * @param type $id
     * @param type $order
     * @return type
     */
    public static function selectTiKuanData($id,$order){
        $data = Money::find()
                ->andWhere(['id'=>$id]);
        if($order){
            if($order=='order_value'){
                $data = $data->orderBy([$order=>SORT_ASC]);
            }else{
                 $data = $data->orderBy([$order=>SORT_DESC]);
            }
        }else{
            $data = $data->orderBy(['id'=>SORT_DESC]);
        }
        $data = $data->asArray()->all();
        return $data;
    }

/**
 *查询提现时间和订单值 
 * @param type $userId
 */
    public static function selectTxTime($userid){
        $time = Money::find()
                ->select(['update_time','order_value'])
                ->where(['type'=>['后台充值','银行汇款','在线支付']])
                ->andWhere(['status'=>'成功'])
                ->andWhere(['user_id'=>$userid])
                ->orderBy(['update_time'=>SORT_DESC])
                ->limit(1)
                ->asArray()
                ->one();
        return $time;
    
    }
    
    /**
     * 查询今天提款次数
     * @return type
     */
    public static function selectTodayTkCs($userid,$s_time){
         $cs = Money::find()
                 ->select(['count(id) as today_tk_cs'])
                 ->where(['type'=>'用户提款'])
                 ->andWhere(['status'=>'成功'])
                 ->andWhere(['user_id'=>$userid])
                 ->andWhere(['>=','update_time',$s_time." 00:00:00"])
                 ->limit(1)
                 ->asArray()
                 ->one();
        return $cs;
    }
    
    /**
     * 查询提款次数总和
     */
    public static function selectTotalTkCs($userid){
        $total = Money::find()
                ->select('count(id) as total_tk_cs')
                ->where(['type'=>'用户提款'])
                ->andWhere(['status'=>'成功'])
                ->andWhere(['user_id'=>$userid])
                ->limit(1)
                ->asArray()
                ->one();
        return $total;
    }
    
    /**
     * 更新提现状态
     * @param type $mid
     * @param type $about
     * @param type $sxf
     * @return typec
     */
    public static function updateTixianStatus($status,$mid,$about='',$sxf=''){
        if($status ==1){
            $money = Money::find()->where(['id'=>$mid])->andWhere(['or',['status'=>'未结算'],['status'=>'审核中']])->one();
            $money->status = '成功';
            $money->sxf = $sxf;
            $money->about = $about;
        }elseif($status==0){
            $money = Money::find()->where(['id'=>$mid])->andWhere(['or',['status'=>'未结算'],['status'=>'审核中']])->one();
            $money->status = 0;
            $money->about = $about;
        }elseif($status ==3){
            $money = Money::findOne(['id'=>$mid]);
            $money->status = "审核中";
        }
        $money->update_time = date('Y-m-d H:i:s');
        $r = $money->save();
       return $r;
    }
    
    /**
     * 会员正常取款失败，得还款到账户上
     * @param type $about
     * @param type $mid
     * @return type
     */
    public static function updateFalse($about,$mid){
        $sql =  "update money,user_list set money.status='失败',money.update_time=now(),money.about='" . $about. "',"
                . "user_list.money=user_list.money-money.order_value,money.balance=user_list.money-money.order_value "
                . "where user_list.user_id=money.user_id and (money.status='未结算' or money.status='审核中') and money.id=$mid";
        $r =Yii::$app->db->createCommand($sql)->execute();
        return $r;
    }
   
    /**
     * 查询提现失败信息
     */
    public static function selectTixianFalseData($mid){
        $data = Money::find()
                ->select(['money.*','user_list.money as u_balance'])
                ->innerJoin('user_list','user_list.user_id=money.user_id')
                ->where(['money.status'=>'失败'])
                ->andWhere(['money.id'=>$mid])
                ->asArray()
                ->one();
        return $data;
        
    }
    
    /**
     * 插入数据失败是更新money表和user_list表的数据信息
     */
    public static function updateMU($mid){
         $sql = "update money,user_list set money.status='未结算',money.update_time=now(),"
                 . "money.about='" . "" . "',user_list.money=user_list.money+money.order_value,money.balance"
                 . "=user_list.money+money.order_value where user_list.user_id=money.user_id and money.status='失败' and money.id=$mid";;
        $r =Yii::$app->db->createCommand($sql)->execute();
        return $r;
    }

/**
* 查询当天后台加款扣款数据
* @return type
*/
    public static function selectAddMinusMoney(){
        $data = Money::find()
            ->select(['m.id','m.status','m.order_value','m.order_num','m.update_time','m.about','m.id','m.assets','m.balance','m.type','m.user_id','u.user_name'])
            ->from('money as m')
            ->innerJoin('user_list as u', 'm.user_id=u.user_id')
            ->where(['or',['m.type' => '后台充值'], ['m.type' => '后台扣款']]) //所有该会员的存款取款记录
            ->andWhere(['>=','m.update_time',date('Y-m-d 00:00:00')])
            ->andWhere(['<=','m.update_time',date('Y-m-d 23:59:59')])
            ->asArray()
            ->all();
        return $data;
    }

}