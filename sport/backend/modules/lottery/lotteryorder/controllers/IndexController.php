<?php
namespace app\modules\lottery\lotteryorder\controllers;

use app\common\base\BaseController;
use app\common\clients\ARSSClient;
use app\common\data\Pagination;
use app\modules\general\sysmng\models\ar\SysConfig;
use app\modules\general\admin\models\ManageLog;
use app\modules\lottery\lotteryorder\model\OrderLottery;
use Yii;
use yii\helpers\ArrayHelper;

/*
 * 注单控制器
 */
class IndexController extends BaseController{
    public $status = array();
    public $layout = false;
    //初始化函数
    public function init(){
        parent::init();
        //订单状态表示
        $this->status = array(0=>'未结算',1=>'已结算',2=>'重新结算',3=>'已作废','0,1,2,3'=>'全部注单');
    }
	//作废订单 2018-09-25 修正 id:id,cancel_reason:sResult,order_sub_num:order_sub_num
	public function actionZuofei(){
		$id  = $_GET['id'];
		//$arss = new ARSSClient();
        $result = OrderLottery::cancelOrder($id, $_GET['cancel_reason']);
        //ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$manageStr);

		if($result=='0') {
            $manageStr = '作废了彩票订单号:'.$_GET['order_sub_num'].'。理由是：'.$_GET['cancel_reason'];
			return '0';
		}else if($result=='-1'){
            return '-1';
		}else{
            return '1';
        }
	}
	//批量作废 2018-09-25 修正
    public function actionPlzuofei(){
        $postNews = Yii::$app->request->post();
        $str = trim($postNews['aid'],',');
        $arr = explode(',',$str);
        //$arss = new ARSSClient();
        foreach($arr as $k=>$v) {
            if(!empty($v)){
                $result = OrderLottery::cancelOrder($v, '');
                if($result=='-1'){
                    return '操作異常';
                }
            }
        }
        $manageStr = '批量作废了彩票订单号:'.$str.'。理由是：'.$postNews['cancel_reason'];
        //ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$manageStr);
        return '操作完成';
    }
    /*
     * lottery注单
     * 主页
     */
    public function actionIndex(){
		$username = trim($this->getParam('username',''));
        $uid = OrderLottery::uid($username);
		$type = $this->getParam('type','');
        $status = $this->getParam('js');
		$s_time = $this->getParam('s_time',date('Y-m-d 00:00:00'));
		$e_time = $this->getParam('e_time',date('Y-m-d H:i:s'));
		$qishu =  $this->getParam('qishu','');
        $tf_id =  $this->getParam('tf_id','');
        $excludegroup =  $this->getParam('excludegroup','');
        if($username!=''&&$uid==0){
            $PageNull = new Pagination(['totalCount' => 0,'pagesize'=>0]);
            return $this->render('index',array(
                's_time'=>$s_time,'e_time'=>$e_time,
                'status'=>$this->status,
                'list' => '',
                'pages' => $PageNull,
                'bet_money'=>0,
                't_sy'=>'',
                'reload'=>1000
            ));
        }
        if($excludegroup == '1'){
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $excludeids = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
        }
        else{
            $excludeids = null;
        }
        $page_line = SysConfig::getPagesize('caipiao_show_row');
		$result = OrderLottery::chin($status,$type,$uid,$s_time,$e_time,$qishu,$tf_id,$excludeids);
		$page =$result->count();
		$pagination = new Pagination(['totalCount' => $page,'pagesize'=>$page_line]);
		$list = $result->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		$bet_money = 0;
		$t_sy = 0;
		foreach($list as $key => $val){
				$bet_money += $val['bet_money'];
			if ($val['is_win'] == "1") {
				$t_sy = $t_sy + $val['win'] + $val['fs'];
			} elseif ($val['is_win'] == "2") {
				$t_sy+=$val['bet_money'];
			} elseif ($val['is_win'] == "0" && $val['fs'] > 0) {
				$t_sy+=$val['fs'];
			}
		};
        $sysConfig = SysConfig::find()->asArray()->one();
        $reload = ArrayHelper::getValue($sysConfig, 'caipiao_auto', 0) == '1' ? ArrayHelper::getValue($sysConfig, 'caipiao_auto_time', 1000) : 1000;
		return $this->render('index',array(
            's_time'=>$s_time,'e_time'=>$e_time,
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pagination,
			'bet_money'=>$bet_money,
            't_sy'=>$t_sy,
            'excludegroup'=>$excludegroup,
            'reload'=>$reload
		));
    }
        /*
     * lottery注单
     * 主页
     */
     public function actionFsOrder(){
		$username = trim($this->getParam('username',''));
        $uid = OrderLottery::uid($username);
		$type = $this->getParam('type','');
        $status = $this->getParam('js');
		$s_time = $this->getParam('s_time',date('Y-m-d 00:00:00'));
		$e_time = $this->getParam('e_time',date('Y-m-d H:i:s'));
		$qishu =  $this->getParam('qishu','');
		$tf_id =  $this->getParam('tf_id','');
        if($username!=''&&$uid==0){
            $PageNull = new Pagination(['totalCount' => 0,'pagesize'=>0]);
            return $this->render('index',array(
                's_time'=>$s_time,'e_time'=>$e_time,
                'status'=>$this->status,
                'list' => '',
                'pages' => $PageNull,
                'bet_money'=>0,
                't_sy'=>'',
                'reload'=>1000
            ));
        }
        $page_line = SysConfig::getPagesize('caipiao_show_row');
		$result = OrderLottery::fschin($status,$type,$uid,$s_time,$e_time,$qishu,$tf_id);
		$page =$result->count();
		$pagination = new Pagination(['totalCount' => $page,'pagesize'=>$page_line]);
		$list = $result->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		$bet_money = 0;
		$t_sy = 0;
		foreach($list as $key => $val){
				$bet_money += $val['bet_money'];
			if ($val['is_win'] == "1") {
				$t_sy = $t_sy + $val['win'] + $val['fs'];
			} elseif ($val['is_win'] == "2") {
				$t_sy+=$val['bet_money'];
			} elseif ($val['is_win'] == "0" && $val['fs'] > 0) {
				$t_sy+=$val['fs'];
			}
		};
        $sysConfig = SysConfig::find()->asArray()->one();
        $reload = ArrayHelper::getValue($sysConfig, 'caipiao_auto', 0) == '1' ? ArrayHelper::getValue($sysConfig, 'caipiao_auto_time', 1000) : 1000;
		return $this->render('fsindex',array(
            's_time'=>$s_time,'e_time'=>$e_time,
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pagination,
			'bet_money'=>$bet_money,
			't_sy'=>$t_sy,
            'reload'=>$reload
		));
    }
	/*
     * lottery注单按用户
     */
	public function actionLotteryuser(){
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $time['qishu'] = $qishu = $this->getParam('qishu','');
        $time['js'] = $js = $this->getParam('js','0,1,2,3');
        $excludegroup =  $this->getParam('excludegroup','');
        $status= '1=1';
        if($js != '0,1,2,3'){
            $status = ['in','o_sub.status',[$js]];
        }
        $username = $this->getParam('username','');

        $bid = array();
        if($username){
            $uid = OrderLottery::uid($username);
            $bid[0]=$uid;
        }else{
            $uids = OrderLottery::uids($status,$time['s_time'],$time['e_time']);
            foreach ($uids as $key =>$value){
                foreach ($value as $k=>$v){
                    $bid[$key] = $v;
                }
            }
        }
        if($excludegroup == '1'){
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $excludeids = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            foreach ($excludeids as $key => $value) {
                $key = array_search($value['user_id'], $bid);
                if($key)
                {
                    array_splice($bid,$key,1);
                }
            }
        }
        $list = OrderLottery::ByUser($bid,$time['s_time'],$time['e_time'],$status,$qishu);
        $pages = new Pagination(['totalCount' =>count($list->asArray()->all()), 'pageSize' => '20']);
        $lists = $list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('lotteryuser',array(
            'username'=>$username,
            'lists' => $lists,
            'pages' => $pages,
            'time'=>$time,
            'excludegroup'=>$excludegroup,
        ));
	}

	//注单明细
	public function actionOrderdetail(){
		$userId = isset($_GET['user_id'])? $_GET['user_id']:0;
		$orderNum = isset($_GET['order_num']) ? $_GET['order_num'] : 0;
		$result = OrderLottery::getOrderByOrderid($userId,$orderNum);
		$pages = new Pagination(['totalCount' =>count($result->asArray()->all()), 'pageSize' => '20']);
		$list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();
		return $this->render('detail',array(
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pages,
		));
	}

    //核查会员 中奖、反水、 传入子订单
    public function actionOrderSub(){
        $this->layout = false;
        $order_number_sub = $this->getParam('order_num');
        $OrderNum = OrderLottery::getOrderNum($order_number_sub);
        return $this->render('ordersub',array('status'=>$this->status,'list' => $OrderNum));
    }

}
