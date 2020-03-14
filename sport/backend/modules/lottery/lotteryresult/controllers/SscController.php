<?php
namespace app\modules\lottery\lotteryresult\controllers;
use Yii;
use app\modules\lottery\lotteryresult\model\LotteryResultCq;
use app\modules\lottery\lotteryresult\model\LotteryResultTj;
use app\modules\lottery\lotteryresult\model\LotteryResultTs;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\admin\models\ManageLog;
/*
 * 注单控制器
 */
class SscController extends BaseController{
	private $pagesize = 20;
    private $pagecount = 200;
    public $layout=false;

	//lottery - result 重庆时时彩、极速时时彩
    //查询和默认开奖结果首页
    public function actionList(){
        $id	= $this->getParam('id',0);
        $s_time = $e_time = '';
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $lottery_type = $this->getParam('type');
        if($lottery_type=="重庆时时彩"){
            $gType = "cq";
        }elseif($lottery_type=="极速时时彩"){
            $gType = "tj";
        }elseif($lottery_type=="腾讯分分彩"){
            $gType = "ts";
        }
        if($query_time != ''){
            $s_time = $query_time.' 00:00:00';
            $e_time = $query_time.' 23:59:59';
        }
        $list = LotteryResultCq::Ssclist($gType,$s_time,$e_time,$qishu_query);
        $pagecount = $list->count()<$this->pagecount?$list->count():$this->pagecount;
        $pages = new Pagination(['totalCount' =>$pagecount, 'pageSize' => $this->pagesize]);
        $lists = $list->orderBy(array('id'=>SORT_DESC))->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('ssc',['id'=>$id,'lottery_type'=>$lottery_type,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'rows'=>$lists,'pages'=>$pages,]);
    }
    //新增修改操作
    public function actionOperation(){
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return $this->out(false,'修改权限密码错误');
        }
        $id	= $_GET['id'];
        $lottery_type = $_GET['type'];
        if($lottery_type=="重庆时时彩"){
            $gType = "cq";
            $saveModel = new LotteryResultCq();
        }elseif($lottery_type=="极速时时彩"){
            $gType = "tj";
            $saveModel = new LotteryResultTj();
        }elseif($lottery_type=="腾讯分分彩"){
            $gType = "ts";
            $saveModel = new LotteryResultTs();
        }
        if(isset($_GET["action"]) && $_GET["action"]=="add" && $id==0){
            $create_time = date("Y-m-d H:i:s",time());
            $qishu		=	$_POST["qishu"];
            $datetime	=	$_POST["datetime"];
            $ball_1		=	$_POST["ball_1"];
            $ball_2		=	$_POST["ball_2"];
            $ball_3		=	$_POST["ball_3"];
            $ball_4		=	$_POST["ball_4"];
            $ball_5		=	$_POST["ball_5"];
            $row = LotteryResultCq::check_result($gType,$qishu);
            if($row && $row['0']["id"]){
                return $this->out(false,'该期彩票结果已存在，请查询后编辑！');
            }else{
               switch($gType){
                   case 'cq':
                       $saveModel = new LotteryResultCq();
                       break;
                   case 'tj':
                       $saveModel = new LotteryResultTj();
                       break;
                    case 'ts':
                       $saveModel = new LotteryResultTs();
                       break;
               }
               $saveModel->qishu = $qishu;
               $saveModel->create_time = $create_time;
               $saveModel->datetime = $datetime;
               $saveModel->ball_1 = $ball_1;
               $saveModel->ball_2 = $ball_2;
               $saveModel->ball_3 = $ball_3;
               $saveModel->ball_4 = $ball_4;
               $saveModel->ball_5 = $ball_5;
               $saveModel->save();
               $str = $lottery_type.'新增期數:'.$qishu.'號碼:'.$ball_1.','.$ball_2.','.$ball_3.','.$ball_4.','.$ball_5;
               ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str);
               return $this->out(true, "添加成功!");
            }
        }else if($_GET["action"]== 'edit' && $id>0){
           $where['id'] = $id;
           $table = 'lottery_result_'."$gType";
           $resule_id = LotteryResultCq::find()
               ->select('*')
               ->from($table)
               ->where($where);
           $lists = $resule_id->limit('1')->asArray()->all();
           if($gType=='cq'){
               $saveModel = new LotteryResultCq();
           }elseif($gType=='ts'){
                $saveModel = new LotteryResultTs();
           }else{
               $saveModel = new LotteryResultTj();
           }
           $orderSub = $saveModel::findOne($id);
           if($orderSub){
               $create_time = date("Y-m-d H:i:s",time());
               $orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"].",".$lists['0']["ball_4"].",".$lists['0']["ball_5"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"].",".$_POST["ball_4"].",".$_POST["ball_5"]."。".'<br /><br />'.$lists['0']["prev_text"];
               $orderSub->qishu = $_POST["qishu"];
               $orderSub->create_time = $create_time;
               $orderSub->datetime = $_POST["datetime"];
               $orderSub->ball_1 = $_POST["ball_1"];
               $orderSub->ball_2 = $_POST["ball_2"];
               $orderSub->ball_3 = $_POST["ball_3"];
               $orderSub->ball_4 = $_POST["ball_4"];
               $orderSub->ball_5 = $_POST["ball_5"];
               $orderSub->update();
               return $this->out(true, "修改成功!");
           }
        }
    }
    //编辑返回视图
    public function actionEdit(){
        $id = $this->getParam('id');
        $lottery_type = $_GET['type'];
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        if($lottery_type=="重庆时时彩"){
            $gType = "cq";
        }elseif($lottery_type=="极速时时彩"){
            $gType = "tj";
        }elseif($lottery_type=="腾讯分分彩"){
            $gType = "ts";
        }
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $where['id'] = $id;
        $table = 'lottery_result_'."$gType";
        $resule_id = LotteryResultCq::find()
            ->select('*')
            ->from($table)
            ->where($where);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('ssc',['id'=>$id,'lottery_type'=>$lottery_type,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
}
