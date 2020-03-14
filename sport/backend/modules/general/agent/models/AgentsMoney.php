<?php
namespace app\modules\general\agent\models;

use app\modules\general\agent\models\AgentsList;
use Yii;
use yii\db\ActiveRecord;

/**
 * 資金操作
 */
class AgentsMoney extends ActiveRecord{
    public static function findAllMoneyByTypeAndStatus($type, $status, $startTime, $endTime) {
        $query = AgentsMoney::find()->where(['and', ['type'=> $type], ['status'=> $status], ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime]]);
        return $query->orderBy('id desc')->asArray()->all();
    }
    /*
     * 後台充值
     * @$uid   用戶ID
     * @$order  單號
     * @$money  操作金額
     * @$assets  操作前用戶金額
     * @$about  操作理由
     */
    public static function chongzhi($uid, $order, $money, $assets,$about = '')
    {
        $moneyModel = new AgentsMoney();
        $moneyModel->user_id = $uid;
        $moneyModel->order_value = $money;
        $moneyModel->status = '成功';
        $moneyModel->order_num = $order;
        $moneyModel->about = $about;
        $moneyModel->assets = $assets;
        $moneyModel->balance = $assets+$money;
        $moneyModel->type = '總代理存款';
        $moneyModel->update_time = date('Y-m-d H:i:s');
        $result = $moneyModel->save();
        return $result;
    }
    /*
     * 後台提現
     * @$uid   用戶ID
     * @$order  單號
     * @$money  操作金額
     * @$assets  操作前用戶金額
     * @$about  操作理由
     */
    public static function tixian($uid,$order, $money, $assets, $about = '')
    {
        $moneyModel = new AgentsMoney();
        $moneyModel->user_id = $uid;
        $moneyModel->order_value = 0-$money;
        $moneyModel->status = '成功';
        $moneyModel->order_num = $order;
        $moneyModel->about = $about;
        $moneyModel->assets = $assets;
        $moneyModel->balance = ($assets-$money)<=0 ? 0:$assets-$money;
        $moneyModel->type = '轉入下層';
        $moneyModel->update_time = date('Y-m-d H:i:s');
        $result = $moneyModel->save();
        return $result;
    }

    /*
     * 資金操作用戶組
     * $userIn  查詢的用戶
     * $userNin  忽略的用戶
     * $startTime  開始時間
     * $endTime    結束時間
     */
    public static function LogUser($userIn,$userNin,$startTime,$endTime){
        $list = AgentsMoney::find()
            ->select(array("u.id","u.agents_name"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id");
        if(!empty($userIn)){
            $list->andWhere(array('in','u.agents_name',$userIn));
        }
        if(!empty($userNin)){
            $list->andWhere(array('not in','u.agents_name',$userNin));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->groupBy(array('u.id'));
        return $list;
    }

    /*
     * 匯款資金日誌(不包括活動資金)
     * $userIn  查詢的用戶
     * $userNin  忽略的用戶
     * $startTime  開始時間
     * $endTime    結束時間
     */
    public static function MoneyLog($userIn,$userNin,$startTime,$endTime){
        $list = AgentsMoney::find()
            ->select(array("SUM(m.order_value) AS huikuan","u.id","u.agents_name"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id")
            ->where(array('m.type'=>'銀行匯款','m.status'=>'成功'))
            ->andWhere(array('not like','m.about', '用於活動'));
        if(!empty($userIn)){
            $list->andWhere(array('in','u.agents_name',$userIn));
        }
        if(!empty($userNin)){
            $list->andWhere(array('not in','u.agents_name',$userNin));
        }
        if($startTime){
            $list->andWhere('m.update_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('m.update_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->groupBy(array('u.id'))->orderBy(array('huikuan' => SORT_DESC));

        return $list;
    }

    /*
     * 存款資金日誌
     * $user  查詢的用戶
     * $startTime  開始時間
     * $endTime    結束時間
     * $type       是否用於活動（1：是，0：否）
     */
    public static function ckLog($user,$startTime,$endTime,$type){
        $list = AgentsMoney::find()
            ->select(array("SUM(m.order_value) AS order_value","u.id","u.agents_name"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id")
            ->where(array('m.status'=>'成功'))
            ->andWhere(['or','m.type=:typeO','m.type=:typeT'], [':typeO' => '在線支付',':typeT' => '後台充值']);
        if($type==1){
            $list->andWhere(array('like','m.about', '用於活動'));
        }else{
            $list->andWhere(array('not like','m.about', '用於活動'));
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
        
        $list->groupBy(array('u.id'))->orderBy(array('order_value' => SORT_DESC));

        return $list;
    }
    /*
     * 取款資金日誌
     * $user  查詢的用戶
     * $startTime  開始時間
     * $endTime    結束時間
     * $type       是否用於活動（1：是，0：否）
     */
    public static function qkLog($user,$startTime,$endTime,$type){
        $list = AgentsMoney::find()
            ->select(array("SUM(m.order_value) AS order_value","u.id","u.agents_name"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id")
            ->where('m.order_value < :order_value',[':order_value'=>0])
            ->andWhere(array('m.status'=>'成功'));
            if($type==1){
                $list->andWhere(array('like','m.about', '用於活動'));
            }else{
                $list->andWhere(array('not like','m.about', '用於活動'));
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
        $list->groupBy(array('u.id'))->orderBy(array('order_value' => SORT_DESC));
        return $list;
    }

    /*
     * 匯款明細
     * $user  查詢的用戶
     * $startTime  開始時間
     * $endTime    結束時間
     * $order      排序字段
     * $status     狀態
     * $bank       操作銀行
     */
    public static function huikuan($user,$startTime,$endTime,$order,$status,$bank){
        $list = AgentsMoney::find()
            ->select(array("m.*","u.id","u.agents_name"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id")
            ->where(array('m.type'=>'銀行匯款'));
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
            if($status=='未結算'){
                $list->andWhere(['or','m.status=:statusO','m.status=:statusT'], [':statusO' => '未結算',':statusT' => '審核中']);
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
    * 訂單明細
    * $id  查詢的訂單ID
    */
    public static function moneyDetail($id){
        $list = AgentsMoney::find()
            ->select(array("m.*","u.id","u.agents_name","u.pay_name","u.remark"))
            ->from("agents_money as m")
            ->innerJoin("agents_list as u","m.user_id=u.id")
            ->where(array('m.id'=>$id))->asArray()->one();
        return $list;
    }
    
    /*
    * 訂單修改
    * $id  查詢的訂單ID
    * $status 操作狀態
    * $sxfBl  贈送金額
    */
    public static function updateMoney($id,$status,$sxfBl){
        $huikuan = AgentsMoney::findOne(array('id'=>$id));
        //匯款失敗操作
        if($status==2){
            if(!$huikuan || ($huikuan->status!='未結算' && $huikuan->status!='審核中')){
                return '此匯款單已操作完成，不能做失敗處理！';
            }
            if($huikuan->status=='失敗') return '已經是匯款失敗狀態了';
            if($huikuan->status=='成功') return '已經是匯款成功狀態了';
            $huikuan->status = '失敗';
            $huikuan->balance = $huikuan->assets;
            return $huikuan->save() ? '操作成功':'操作失敗';
        }
        if(!$huikuan) return '找不到要操作的匯款單';
        //匯款成功
        if($status==1){
            if($huikuan->status=='成功') return '已經加過款了，請不要重複加';
            $orderMoney = $huikuan->order_value;
            $userId = $huikuan->user_id;
            $orderNum = $huikuan->order_num;
            $user = UserList::findOne(array('user_id'=>$userId));
            if(!$user) return "找不到您要操作的用戶!";
            $zsjr = floor($orderMoney * $sxfBl) * 1;
            $userMoney = $user->money;
            //修改用戶金額
            $user->money = $user->money+$orderMoney+$zsjr;
            $resultUser = $user->save();
            //修改匯款單
            $huikuan->status = '成功';
            $huikuan->zsjr = $zsjr;
            $huikuan->balance = $userMoney+$orderMoney+$zsjr;
            $resultHuikuan = $huikuan->save();
            if(!$resultUser && $resultHuikuan){
                return '更新金額失敗';
            }
            $moneyLog = new MoneyLog();
            $moneyLog->user_id = $userId;
            $moneyLog->order_num = $orderNum;
            $moneyLog->about = '';
            $moneyLog->update_time = date('Y-m-d H:i:s');
            $moneyLog->type = '用戶匯款成功';
            $moneyLog->order_value = $orderMoney+$zsjr;
            $moneyLog->assets = $userMoney;
            $moneyLog->balance =  $userMoney+$orderMoney+$zsjr;
            if(!$moneyLog->save()){
                $huikuan = AgentsMoney::findOne(array('id'=>$id,'status'=>'成功'));
                $user = UserList::findOne(array('user_id'=>$userId));
                if($huikuan && $user){
                    $orderValue = $huikuan->order_value;
                    $userMoney = $user->money;
                    //修改匯款單
                    $huikuan->status = '未結算';
                    $huikuan->update_time = date('Y-m-d H:i:s');
                    $huikuan->about = "";
                    $huikuan->balance = $userMoney-$orderValue;
                    $huikuan->save();
                    $user->money = $userMoney-$orderValue;
                    $user->save();
                    return '插入金錢記錄失敗，操作失敗';
                }
                return "找不到您要操作的用戶或匯款單!";
            }
            return '操作成功';
        }
        //匯款審核中
        if($status==3){
            if($huikuan->status=='審核中') return '已經是審核中了';
            $huikuan->status = '審核中';
            $huikuan->balance = $huikuan->assets;
            return $huikuan->save() ? '操作成功':'操作失敗';
        }
    }

 /**
     *  查詢存款數據的id;
     * @param type $status
     * @param type $username
     * @param type $time_start
     * @param type $time_end
     * @param type $order
     * @return type
     */
    public static function selectCunkuanId($status,$username,$time_start,$time_end,$order){
        $id = AgentsMoney::find()
                ->select(["id"])
                ->where([">=","order_value",0])
                ->andWhere(["or",["type"=>"在線支付"],["type"=>"後台充值"]]);
        if($status){
            if($status != "全部存款" && $status != "未結算"){
                $id = $id->andWhere(["status"=>$status]);
            }
            if($status == "未結算"){
                $id = $id->andWhere(["or",["status"=>"未結算"],["status"=>"審核中"]]);
            }
            if($status == "在線支付"){
                $id = AgentsMoney::find()
                         ->select(["id"])
                         ->where([">=","order_value","0"])
                         ->andWhere(["status"=>"成功"])
                         ->andWhere(["type"=>"在線支付"]);
            }
            if($status == "後台充值"){
                $id = AgentsMoney::find()
                         ->select(["id"])
                         ->where([">=","order_value","0"])
                         ->andWhere(["type"=>"後台充值"]);
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
     * 查詢存款管理的數據並分頁
     */
    public static function selectCunkuanData($mid,$order){
        $data = AgentsMoney::find()
                ->where(["id"=>$mid])
                ->orderBy([$order=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
    }
    
    /**
     * 查詢財務信息
     * @param type $time_start
     * @param type $time_end
     * @param type $username
     * @param type $status
     * @return type
     */
    public static function selectCaiwuData($time_start,$time_end,$username,$status){
        $data = AgentsMoney::find()
                ->select("m.id,m.status,m.order_value,m.order_num,m.update_time,m.about,m.id,m.assets,m.balance,m.type,m.user_id")
                ->from("agents_money as m")
                ->innerJoin('user_list as u', 'm.user_id=u.id')
                ->where(["or", ["m.type" => "在線支付"], ["m.type" => "用戶提款"], ["m.type" => "後台充值"], ["m.type" => "後台扣款"], ["m.type" => "銀行匯款"]]); //所有該會員的存款取款記錄
        if ($time_start) {
            $stime = $time_start . ' 00:00:00';
            $data = $data->andWhere([">=","m.update_time",$stime]);
        }
        if ($time_end) {
            $etime = $time_end . ' 23:59:59';
            $data = $data->andWhere(["<=","m.update_time",$etime]);
        }
        if ($username){
             $data = $data->andWhere(["u.agents_name"=>$username]);
        }
        if($status!="所有狀態" && $status!="未結算"){
            $data = $data->andWhere(["m.status"=>$status]);
        }
        if ($status == "未結算") {
            $data = $data->andWhere(["or",["m.status"=>"未結算"],["m.status"=>"審核中"]]);
        }
        $data->orderBy(array('m.update_time'=>SORT_DESC));
        return $data;
    }
    
    /**
     * 查詢財務信息
     */
    public static function selectCaiwuData1($time_start,$time_end,$username,$status){
         $data = (new \yii\db\Query())
                ->select("m.id,m.status,m.order_value,m.order_num,m.update_time,m.id,m.assets,m.balance,m.pay_card")
                ->from("agents_money as m")
                ->leftJoin('user_list as u', 'm.user_id=u.id')
                ->where(["m.type" => "銀行匯款"]); //所有該會員的存款取款記錄
         if ($time_start) {
            $stime = $time_start . ' 00:00:00';
            $data = $data->andWhere([">=","m.update_time",$stime]);
        }
        if ($time_end) {
            $etime = $time_end . ' 23:59:59';
            $data = $data->andWhere(["<=","m.update_time",$etime]);
        }
        if ($username){
             $data = $data->andWhere(["u.agents_name"=>$username]);
        }
        if($status!="所有狀態"){
            $data = $data->andWhere(["m.status"=>$status]);
        }
        $data = $data->all();
        return $data;
    }

   
    
    
    
  public static function selectCk($mid){
        $data = AgentsMoney::find()
                ->select("user_list.user_id,money.order_num,money.order_value,user_list.money as assets")
                ->leftJoin("user_list","money.user_id=user_list.user_id")
                ->andWhere("money.id=:mid",[':mid'=>$mid])
                ->asArray()
                ->one();
        return $data;
    }
    
    /**
     * 更新ck數據
     * @param type $mid
     * @return type
     */
    public static function updateCkSuccess($mid){
         $sql = "update money,user_list set money.status='成功',money.update_time=now(),user_list.money=user_list.money+money.order_value,"
                 . "money.about='該訂單手工操作成功',"
                 . "money.sxf=money.order_value/100,money.balance=user_list.money+money.order_value "
                 . "where money.user_id=user_list.user_id and money.id='$mid' and money.`status`='未結算'";
         $r = Yii::$app->db
                ->createCommand($sql)
                ->execute();
         return $r;
    }
    
    /**
     * 更新狀態
     * @param type $mid
     * @return type
     */
    public static function updateCkStatus($mid){
        $sql = "update money,user_list set money.status='未結算',money.update_time=now(),user_list.money="
                . "user_list.money-money.order_value,money.about='該訂單手工操作失敗',money.sxf=money.order_value/100,"
                . "money.balance=user_list.money-money.order_value where money.user_id=user_list.user_id and money.id='$mid'"
                . " and money.`status`='成功'";
        $r = Yii::$app->db
                ->createCommand($sql)
                ->execute();
         return $r;
    }
    
    /**
     * 更新存款失敗數據
     */
    public static function updateCkFalse($mid){
        $r = 0;
        $money = AgentsMoney::find()->where(['id'=>$mid])->andWhere(['status'=>'未結算'])->one();
        if($money){
            $money->status = '失敗';
            $money->about = '該訂單手工操作失敗';
            $money->balance = $money->assets;
            $r = $money->save();
        }
        return $r;
    }

    /**
     * 查詢提款列表id
     * @param type $status 狀態全部提款；未處理；提款失敗；提款成功
     * @param type $username  用戶名
     * @param type $time_start
     * @param type $time_end
     * @return type
     */
    public static function selectTikuanId($status,$username,$time_start,$time_end,$order){
        $id = AgentsMoney::find()
                ->select(["id"])
                ->where(['<','order_value',0]);
        if($status){
            if($status != "全部提款" && $status != "未結算"){
                $id = $id->andWhere('status=:status',[':status'=>$status]);
            }
            if($status == "未結算"){
                $id = $id->andWhere(['or',['status'=>'未結算'],['status'=>'審核中']]);
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
     * 查詢提現信息
     * @param type $id
     * @param type $order
     * @return type
     */
    public static function selectTiKuanData($id,$order){
        $data = AgentsMoney::find()
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
 *查詢提現時間和訂單值 
 * @param type $userId
 */
    public static function selectTxTime($userid){
        $time = AgentsMoney::find()
                ->select(['update_time','order_value'])
                ->where(['type'=>['後台充值','銀行匯款','在線支付']])
                ->andWhere(['status'=>'成功'])
                ->andWhere(['user_id'=>$userid])
                ->orderBy(['update_time'=>SORT_DESC])
                ->limit(1)
                ->asArray()
                ->one();
        return $time;
    
    }
    
    /**
     * 查詢今天提款次數
     * @return type
     */
    public static function selectTodayTkCs($userid,$s_time){
         $cs = AgentsMoney::find()
                 ->select(['count(id) as today_tk_cs'])
                 ->where(['type'=>'用戶提款'])
                 ->andWhere(['status'=>'成功'])
                 ->andWhere(['user_id'=>$userid])
                 ->andWhere(['>=','update_time',$s_time." 00:00:00"])
                 ->limit(1)
                 ->asArray()
                 ->one();
        return $cs;
    }
    
    /**
     * 查詢提款次數總和
     */
    public static function selectTotalTkCs($userid){
        $total = AgentsMoney::find()
                ->select('count(id) as total_tk_cs')
                ->where(['type'=>'用戶提款'])
                ->andWhere(['status'=>'成功'])
                ->andWhere(['user_id'=>$userid])
                ->limit(1)
                ->asArray()
                ->one();
        return $total;
    }
    
    /**
     * 更新提現狀態
     * @param type $mid
     * @param type $about
     * @param type $sxf
     * @return typec
     */
    public static function updateTixianStatus($status,$mid,$about='',$sxf=''){
        if($status ==1){
            $money = AgentsMoney::find()->where(['id'=>$mid])->andWhere(['or',['status'=>'未結算'],['status'=>'審核中']])->one();
            $money->status = '成功';
            $money->sxf = $sxf;
            $money->about = $about;
        }elseif($status==0){
            $money = AgentsMoney::find()->where(['id'=>$mid])->andWhere(['or',['status'=>'未結算'],['status'=>'審核中']])->one();
            $money->status = 0;
            $money->about = $about;
        }elseif($status ==3){
            $money = AgentsMoney::findOne(['id'=>$mid]);
            $money->status = "審核中";
        }
        $money->update_time = date('Y-m-d H:i:s');
        $r = $money->save();
       return $r;
    }
    
    /**
     * 會員正常取款失敗，得還款到賬戶上
     * @param type $about
     * @param type $mid
     * @return type
     */
    public static function updateFalse($about,$mid){
        $sql =  "update money,user_list set money.status='失敗',money.update_time=now(),money.about='" . $about. "',"
                . "user_list.money=user_list.money-money.order_value,money.balance=user_list.money-money.order_value "
                . "where user_list.user_id=money.user_id and (money.status='未結算' or money.status='審核中') and money.id=$mid";
        $r =Yii::$app->db->createCommand($sql)->execute();
        return $r;
    }
   
    /**
     * 查詢提現失敗信息
     */
    public static function selectTixianFalseData($mid){
        $data = AgentsMoney::find()
                ->select(['money.*','user_list.money as u_balance'])
                ->innerJoin('user_list','user_list.user_id=money.user_id')
                ->where(['money.status'=>'失敗'])
                ->andWhere(['money.id'=>$mid])
                ->asArray()
                ->one();
        return $data;
        
    }
    
    /**
     * 插入數據失敗是更新money表和user_list表的數據信息
     */
    public static function updateMU($mid){
         $sql = "update money,user_list set money.status='未結算',money.update_time=now(),"
                 . "money.about='" . "" . "',user_list.money=user_list.money+money.order_value,money.balance"
                 . "=user_list.money+money.order_value where user_list.user_id=money.user_id and money.status='失敗' and money.id=$mid";;
        $r =Yii::$app->db->createCommand($sql)->execute();
        return $r;
    }

/**
* 查詢當天後台加款扣款數據
* @return type
*/
    public static function selectAddMinusMoney($s_time='',$e_time='',$level=''){
        if(!$s_time || !$e_time){
            $s_time = date('Y-m-d 00:00:00');
            $e_time = date('Y-m-d 23:59:59');
        }

        $data = AgentsMoney::find()
            ->select(['m.id','m.status','m.order_value','m.order_num','m.update_time','m.about','m.id','m.assets','m.balance','m.type','m.user_id','u.agents_name'])
            ->from('agents_money as m')
            ->innerJoin('agents_list as u', 'm.user_id=u.id')
            ->where(['or',['m.type' => '總代理存款']]) //所有該會員的存款取款記錄
            ->andWhere(['>=','m.update_time',$s_time])
            ->andWhere(['<=','m.update_time',$e_time]);
        if($level){
               $data = $data->andWhere(['=','u.id',$level]);
        }
        $data = $data->asArray()->all();
        return $data;
    }

}