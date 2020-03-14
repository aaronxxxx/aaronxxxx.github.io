<?php
namespace app\modules\spsix\controllers;

use app\common\base\BaseController;
use app\common\clients\ARSSClient;
use app\common\data\Pagination;
use app\modules\general\sysmng\models\ar\SysConfig;
use app\modules\spsix\models\LotteryResultLhc;
use app\modules\spsix\models\SpsixLotteryLog;
use app\modules\spsix\models\SpsixLotteryOrder;
use app\modules\spsix\models\SpsixLotteryOrderSub;
use app\modules\spsix\models\SpsixLotterySchedule;
use Yii;
/*
 * 注单控制器
 */
class IndexController extends BaseController{
    public $layout=false;
    public $status = array();
	public $pageSize = 20;
	public function init(){//初始化函数
		parent::init();
        //订单状态表示
        $this->status = array(0=>'未结算',1=>'已结算',2=>'重新结算',3=>'已作废','0,1,2,3'=>'全部注单');
		$this->pageSize = SysConfig::getPagesize('lhc_show_row');
	}
    /**
     * 导出注单到excel文件中
     */
    public function  actionOrderExcel(){
        require( '/../vendor/PHPExcel-1.8.1/Classes/PHPExcel.php');
        $objectPHPExcel = new \PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);

        $page_size = 152;


        $user = $this->getParam('user_name','');
        $startTime = $this->getParam('start_time',date('Y-m-d 00:00:00',time()));
        $endTime = $this->getParam('end_time',date('Y-m-d H:i:s',time()));
        $qishu = $this->getParam('qishu','');
        $status =  $this->getParam('status','0,1,2,3');
        $orderSubNum =$this->getParam('order_sub_num','');
        $data = SpsixLotteryOrder::getOrderById($status,$user,$startTime,$endTime,$qishu,$orderSubNum);
        $count = $data->count();//总数据条数
        $lists = $data->asArray()->all();
//        $model = new NewsSearch();
//        $dataProvider = $model->search();
//        $dataProvider->setPagination(false);
//        $data = $dataProvider->getData();
//        $count = $dataProvider->getTotalItemCount();

        $page_count = (int)($count/$page_size) +1;
        $current_page = 0;
        $n = 0;
        foreach ( $lists as $key=>$order )
        {
            if ( $n % $page_size === 0 )
            {
                $current_page = $current_page +1;

                //报表头的输出
                $objectPHPExcel->getActiveSheet()->mergeCells('B1:G1');
                $objectPHPExcel->getActiveSheet()->setCellValue('B1','极速六合彩注单');

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','极速六合彩注单');
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','极速六合彩注单');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
                    ->getAlignment();//->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','导出日期：'.date("Y年m月d日"));
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G2','第'.$current_page.'/'.$page_count.'页');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('G2')
                    ->getAlignment();//->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                //表格头的输出
                $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3','编号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3','子订单号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','彩票类别');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','彩票期号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3','投注玩法');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3','投注内容');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H3','投注金额');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I3','反水');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('J3','赔率');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('K3','可赢金额');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('L3','输赢结果');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('M3','投注时间');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('N3','投注账号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('O3','状态');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);

            }
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+4) ,$key+1);
            $objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+4) ,$order['order_sub_num']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+4) ,'极速六合彩');
            $objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,$order['qishu']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F'.($n+4) ,$order['rtype_str_sub']?$order['rtype_str_sub']:$order['rtype_str']);
            $objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,$order['number']);
            $objectPHPExcel->getActiveSheet()->setCellValue('H'.($n+4) ,$order['bet_money']);
            $objectPHPExcel->getActiveSheet()->setCellValue('I'.($n+4) ,$order['fs']);
            $objectPHPExcel->getActiveSheet()->setCellValue('J'.($n+4) ,$order['bet_rate']);
            $objectPHPExcel->getActiveSheet()->setCellValue('K'.($n+4) ,$order['win_sub']);
            if($order['status']!=0 && $order['status']!=3){
                if($order['is_win']==1){
                    $res =  $order['win_sub']+$order['sub_fs']-$order['bet_money'];
                }else{
                    $res= ($order['is_win_total']-$order['bet_money']);
                }
            }else if($order['status']==0){
                $res= 0;
            }else{
                $res=  0;
            }
            $objectPHPExcel->getActiveSheet()->setCellValue('L'.($n+4) ,$res);
            $objectPHPExcel->getActiveSheet()->setCellValue('M'.($n+4) ,$order['bet_time']);
            $objectPHPExcel->getActiveSheet()->setCellValue('N'.($n+4) ,$order['user_name']);
            $objectPHPExcel->getActiveSheet()->setCellValue('O'.($n+4) ,$this->status[$order['status']]);
            $n = $n +1;
        }

        //设置分页显示
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);


        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'极速六合彩注单表-'.date("Y年m月j日").'.xls"');
        $objWriter=  \PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
        if(!is_dir('excel')){
            mkdir('./excel',0777);
        }
        $file_name = 'excel/'.date("Y-m-d-H-i-s").".xls";
        $objWriter->save($file_name);
        return $this->out(true,$file_name);
    }
    /*
     * 极速六合彩注单(按用户)
     */
    public function actionIndex(){//网站(默认)主页)
        $user = $this->getParam('user_name','');
        $startTime = $this->getParam('start_time',date('Y-m-d 00:00:00',time()));
        $endTime = $this->getParam('end_time',date('Y-m-d H:i:s',time()));
        $qishu = $this->getParam('qishu','');
        $status =  $this->getParam('status','0,1,2,3');

        //查询优化处理后的
//        if(empty($user)){
//            $data = SpsixLotteryOrder::userOrderCountByOptimize($status,$user,$startTime,$endTime,$qishu);
//            $count = $data->count();//下注的总人数
//        }else{
//            $count=1;
//        }
//        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pageSize]);
//        $list = SpsixLotteryOrder::userOrderByOptimize($status,$user,$startTime,$endTime,$qishu,$pages->offset,$this->pageSize);

		$result = SpsixLotteryOrder::userOrder($status,$user,$startTime,$endTime,$qishu);
        $count = $result->count();
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pageSize]);
		$list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return $this->render('index',array(
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pages,
			'user' =>$user,
			'startTime'=>$startTime,
			'endTime'=>$endTime,
			'qishu'=>$qishu,
			'statu'=>$status
		));
    }

	/*
 	* 极速六合彩注单(按注单)
	* @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
    * @$user 用户名
    * @$startTime 下订单的最小时间
    * @$endTime   下订单的最大时间
    * @$qishu     极速六合彩期数
    * @$orderSubNum  子订单ID
 	*/
	public function actionOrder(){

		$user = $this->getParam('user_name','');
		$startTime = $this->getParam('start_time',date('Y-m-d 00:00:00',time()));
		$endTime = $this->getParam('end_time',date('Y-m-d H:i:s',time()));
		$qishu = $this->getParam('qishu','');
		$status =  $this->getParam('status','0,1,2,3');
		$orderSubNum =$this->getParam('order_sub_num','');

        //查询优化处理后的
//		if($user){
//		    $user_result = SpsixLotteryOrder::getUserId($user);
//		   $user_id = $user_result['user_id'];
//        }else{
//		    $user_id='';
//        }
//        if(empty($user)|| !empty($user_id)) {//用户存在时再继续查询数据
//            $result = SpsixLotteryOrder::getOrderByIdByOptimize($status, $user_id, $startTime, $endTime, $qishu, $orderSubNum);
//            if($user){
//               $count= $result->count();
//            }else{
//                $count= SpsixLotteryOrder::getOrderByIdByOptimizeCount($status, $startTime, $endTime, $qishu, $orderSubNum);
//            }
//            $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
//            $list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();
//        }else{//用户不存在直接返回空结果
//            $pages = new Pagination(['totalCount' => 0, 'pageSize' => $this->pageSize]);
//		    $list=array();
//        }

		$result = SpsixLotteryOrder::getOrderById($status,$user,$startTime,$endTime,$qishu,$orderSubNum);
        $count = $result->count();//总数据条数
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pageSize]);
		$list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        $config = SysConfig::find()->select('lhc_auto,lhc_auto_time')->asArray()->one();
        $reload = ($config['lhc_auto']==1)?$config['lhc_auto_time']:1000;
        return $this->render('order',array(
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pages,
			'user' =>$user,
			'startTime'=>$startTime,
			'endTime'=>$endTime,
			'qishu'=>$qishu,
			'statu'=>$status,
			'orderSubNum'=>$orderSubNum,
            'reload'=>$reload
		));
	}
	/*
	 * 极速六合彩订单作废
	 * @$subId   子订单号
	 */
	public function actionOrderCancel(){
		$this->layout = false;
		$subId = $this->getParam('sub_id',"");
		if(!$subId){
			$data = '请选择要作废的子订单';
			return $data;
		}

		return $this->renderPartial('cancel');
	}
	/*
 	* 极速六合彩订单作废
 	* @$subId   子订单号
 	*/
	public function actionDoOrderCancel(){
		$this->layout = false;
		$subId = $this->getParam('sub_id',"");
		$reason = $this->getParam('reson',"");
		$update = $this->getParam('update',"");
		if(!$subId){
			$data = '请选择要作废的子订单';
			return $data;
		}
		if($update){
			if(!$reason){
				$data = '请输入作废原因';
				return $data;
			}
            $status = SpsixLotteryOrderSub::getOrderStatus($subId);//查询注单状态
            if($status['status']==3){
                return '订单已作废，请勿重复操作!';
            }else {
                if ($result = SpsixLotteryOrder::cancelOrder($subId, $reason)) {
                    $data = '订单作废成功！';
                    return $data;
                }
                $data = '订单作废失败，请重新操作！';
                return $data;
            }
		}else{
			$data = '请选择要作废的子订单';
			return $data;
		}
	}

    /*
     * 极速六合彩注单修改内容
     *查询需要修改的注单内容spsix_lottery_log
     */
    public function actionOrderSubUpdate(){
        $this->layout = false;
        $oldNumber = '';
        $subId = $this->getParam('sub_id',0);
        if(!$subId){
            $data = '请选择要修改的子订单';
            return $data;
        }
        $orderSub = SpsixLotteryOrderSub::findOne(array('id'=>$subId));
        $r = SpsixLotteryOrder::findOne(array('order_num'=>$orderSub['order_num']));
        $t = SpsixLotterySchedule::findOne(array('qishu'=>$r['lottery_number']));
        if(strtotime($t['fenpan_time']) < time()){
            return '该期已经封盘，不允许再修改订单！';
        }
        if($orderSub){
            // 首先去掉头尾空格
            $oldNumber = trim($orderSub->number);
            // 接着去掉两个空格以上的
            $oldNumber = preg_replace('/\s(?=\s)/','',$oldNumber);
        }else{
            return '找不到您要修改的子订单！';
        }
        return $this->renderPartial('update',array('number'=>$oldNumber));
    }
    /*
	 * 极速六合彩注单修改内容,生成管理员日志使用，勿删（---- from zw  change jhh）
	 */
    public function actionOrderSubUpdateDo(){
        $number = $this->getParam('number','');
        $subId = $this->getParam('sub_id',0);
        if($number && $subId){
            if(!$number){
                $data = '请输入要修改的内容';
                return $data;
            }
            if(SpsixLotteryOrderSub::subUpdate($subId,$number)){
                $data = '订单修改成功！';
                return $data;
            }
            $data = '订单修改，请重新操作！';
            return $data;
        }
    }

	/*
	 * 查询极速六合彩注单修改内容
	 */
	public function actionOrderLog(){
		$subId = $this->getParam('sub_id',0);
		$list = SpsixLotteryLog::find()->where(array('id_sub'=>$subId))->orderBy(array('id'=>SORT_DESC))->asArray()->all();
		return $this->renderPartial('log',array('list'=>$list));
	}

	//极速六合彩修改
	public function actionUpdateQishu(){

		$qishu = $this->getParam('qishu',0);
		$kaipanTime = $this->getParam('kaipan_time',0);
		$fenpanTime = $this->getParam('fenpan_time',0);
		$kaijiangTime = $this->getParam('kaijiang_time',0);
		$update = $this->getParam('update',0);
		$id = $this->getParam('id',0);
        if(!is_numeric($qishu)){
            return $this->out(false,'期数格式错误');
        }
		if($qishu && $kaipanTime && $fenpanTime && $kaijiangTime){
			if($update && $id){
				$saveModel = SpsixLotterySchedule::findOne(array('id'=>trim($id)));
				if($saveModel){
					$prev_text = '修改时间：'.date('Y-m-d H:i:s').'。'."<br>".'修改前内容:'."<br>".'开奖期号'.$saveModel->qishu.','."<br>".'开盘时间'.
						$saveModel->kaipan_time.','."<br>".'封盘时间'.$saveModel->fenpan_time.','."<br>".'开奖时间'.$saveModel->kaijiang_time.
						'。'."<br>".'修改后内容:'."<br>".'开奖期号'.$qishu.','."<br>".'开盘时间'.$kaipanTime.
						','."<br>".'封盘时间'.$fenpanTime.','."<br>".'开奖时间'.$kaijiangTime.'。'."<br><br>";
					$saveModel->kaipan_time = date('Y-m-d H:i:s',strtotime($kaipanTime));
					$saveModel->fenpan_time = date('Y-m-d H:i:s',strtotime($fenpanTime));
					$saveModel->kaijiang_time = date('Y-m-d H:i:s',strtotime($kaijiangTime));
					$saveModel->prev_text = $prev_text.$saveModel->prev_text;
					$saveModel->save();
					return $this->out(true, "修改成功");
				}else{
					return $this->out(false, "找不到您要修改的期数!");
				}
			}else{
				$qishu_only = SpsixLotterySchedule::findOne(array('qishu'=>trim($qishu)));
				if($qishu_only){
					return $this->out(false,'期数已经存在');
				}else{
				$saveModel = new SpsixLotterySchedule();
				$saveModel->qishu = trim($qishu);
				$saveModel->kaipan_time = $kaipanTime;
				$saveModel->fenpan_time = $fenpanTime;
				$saveModel->kaijiang_time = $kaijiangTime;
				$saveModel->create_time = date('Y-m-d H:i:s');
				$saveModel->save();
				return $this->out(true, "添加成功");
				}
			}
		}else{
			return $this->out(false,"参数不存在");
		}
	}
	/*
	 * 极速六合彩期数设置
	 */
	public function actionQishu()
	{
		$qishu = $this->getParam('qishu',0);
		$id = $this->getParam('id',0);
		$update = $this->getParam('update',0);
		$qishuQuery = $this->getParam('qishu_query',0);

		$saveData = array('qishu'=>0,'kaipan_time'=>'','fenpan_time'=>'','kaijiang_time'=>'');
		if($qishu){
			$saveData = SpsixLotterySchedule::findOne(array('qishu'=>$qishu));
			if(!$saveData){
				return $this->out(false, "找不到您要修改的期数!");
			}
			$id = $saveData['id'];
			$update = 1;
		}
		if($qishuQuery){
			$qishu = $qishuQuery;
		}
		$schedule = SpsixLotterySchedule::find();
		if($qishu){
			$schedule->where(array('qishu'=>$qishu));
		}
		$pages = new Pagination(['totalCount' =>$schedule->count(), 'pageSize' => $this->pageSize]);
		$list = $schedule->offset($pages->offset)->limit($pages->limit)->orderBy(['create_time'=>SORT_DESC])->asArray()->all();
		return $this->render('qishu',array(
			'list'=>$list,
			'pages'=>$pages,
			'qishu_query'=>$qishu,
			'saveData'=>$saveData,
			'update'=>$update,
			'id'=>$id
		));
	}

	/**
	 * 极速六合彩期数修改记录
	 */
	public function actionQishuLog()
	{
		$post = Yii::$app->request->post();
		$list = array();
		$id = $this->getParam('id',0);
		if($id){
			$list = SpsixLotterySchedule::findOne(array('id'=>trim($id)));
			if(empty($list)){
				return "找不到您要查看的期数!";
			}else{
				if($list->prev_text){
					return $list->prev_text;
				}
				return '该记录未被修改!';
			}
		}else{
			return "找不到您要查看的期数!";
		}
	}

    /**
     * 删除极速六合彩期数
     * @return mixed
     */
	public function actionQishuDelete(){
	    $id= $this->getParam('id',0);
	    if(empty($id)){
	       return $this->out(false,'期数id不能为空');
        }
        $result = SpsixLotterySchedule::findOne(array('id'=>trim($id)))->delete();
	    if($result){
	        return $this->out(true,'删除成功');
        }else{
	        return $this->out(false,'删除失败');
        }
    }
	//添加开奖号码
	public function actionUpdateResult(){

		$qishu = $this->getParam('qishu',0);
		$ball1 = $this->getParam('ball_1',0);
		$ball2 = $this->getParam('ball_2',0);
		$ball3 = $this->getParam('ball_3',0);
		$ball4 = $this->getParam('ball_4',0);
		$ball5 = $this->getParam('ball_5',0);
		$ball6 = $this->getParam('ball_6',0);
		$ball7 = $this->getParam('ball_7',0);
		$dateTime = $this->getParam('datetime',0);
		$update = $this->getParam('update',0);
		$boll =[$ball1,$ball2,$ball3,$ball4,$ball5,$ball6,$ball7];
		if(count(array_unique($boll))!=7){
            return $this->out(false, "开奖号码不能相同!");
        }

		if($qishu && $ball1 && $ball2 && $ball3 && $ball4 && $ball5 && $ball6 && $ball7 && $dateTime){
			if($update){
				$saveModel = LotteryResultLhc::findOne(array('qishu'=>trim($qishu)));
				if($saveModel){
					$prev_text = '修改时间：'.date('Y-m-d H:i:s').'。'."<br>".'修改前内容:'.$saveModel->qishu.':'.$saveModel->ball_1.','.$saveModel->ball_2.','.
					$saveModel->ball_3.','.$saveModel->ball_4.','.$saveModel->ball_5.','.$saveModel->ball_6.','.$saveModel->ball_7.'。'."<br>".'修改后内容:'.":".
					$qishu.':'.$ball1.','.$ball2.','.$ball3.','.$ball4.','.$ball5.','.$ball6.','.$ball7.'。'."<br><br>";
					$saveModel->ball_1 = intval($ball1);
					$saveModel->ball_2 = intval($ball2);
					$saveModel->ball_3 = intval($ball3);
					$saveModel->ball_4 = intval($ball4);
					$saveModel->ball_5 = intval($ball5);
					$saveModel->ball_6 = intval($ball6);
					$saveModel->ball_7 = intval($ball7);
					$saveModel->datetime = date('Y-m-d H:i:s',strtotime($dateTime));
					$saveModel->prev_text = $prev_text.$saveModel->prev_text;
					$saveModel->save();
					return $this->out(true, "修改成功!");
				}else{
					return $this->out(false, "找不到您要修改的期数!");
				}
			}else{
				$qishu_only = LotteryResultLhc::findOne(array('qishu'=>trim($qishu)));
				if($qishu_only){
					return $this->out(false, "期号已经存在！");
				}else{
					$saveModel = new LotteryResultLhc();
					$saveModel->qishu = trim($qishu);
					$saveModel->ball_1 = intval($ball1);
					$saveModel->ball_2 = intval($ball2);
					$saveModel->ball_3 = intval($ball3);
					$saveModel->ball_4 = intval($ball4);
					$saveModel->ball_5 = intval($ball5);
					$saveModel->ball_6 = intval($ball6);
					$saveModel->ball_7 = intval($ball7);
					$saveModel->create_time = date('Y-m-d H:i:s');
					$saveModel->datetime = date('Y-m-d H:i:s',strtotime($dateTime));
					$saveModel->save();
					return $this->out(true, "添加成功!");
				}
			}
		}else{
			return $this->out(false, "参数都要填写!");
		}
	}
	/*
	 * 极速六合彩开奖结果管理
	 */
	public function actionResult()
	{
		$qishu = 0;
		$update = 0;
		$params = Yii::$app->request->get();
		$saveData = array('qishu'=>0,'kaijiang_time'=>'','ball_1'=>0,'ball_2'=>0,'ball_3'=>0,'ball_4'=>0,'ball_5'=>0,'ball_6'=>0,'ball_7'=>0);
		if(isset($params['qishu']) && $params['qishu']){
			$saveData = LotteryResultLhc::findOne(array('qishu'=>$params['qishu']));
			if(!$saveData){
				return "找不到您要编辑的期数！";
			}
			$update = 1;
		}
		if(isset($params['qishu_query']) && $params['qishu_query']){
			$qishu = $params['qishu_query'];
		}
		$schedule = LotteryResultLhc::find();
		if($qishu){
			$schedule->where(array('qishu'=>$qishu));
		}
		$pages = new Pagination(['totalCount' =>$schedule->count(), 'pageSize' => $this->pageSize]);
		$list = $schedule->offset($pages->offset)->limit($pages->limit)->orderBy(['create_time'=>SORT_DESC])->asArray()->all();
		return $this->render('result',array(
			'list'=>$list,
			'pages'=>$pages,
			'qishu_query'=>$qishu,
			'saveData'=>$saveData,
			'update'=>$update
		));
	}
    /*
     * 极速六合彩开奖结果管理 编辑
     */
    public function actionResultEdit()
    {
        $qishu = 0;
        $update = 0;
        $params = Yii::$app->request->get();
        $saveData = array('qishu'=>0,'kaijiang_time'=>'','ball_1'=>0,'ball_2'=>0,'ball_3'=>0,'ball_4'=>0,'ball_5'=>0,'ball_6'=>0,'ball_7'=>0);
        if(isset($params['qishu']) && $params['qishu']){
            $saveData = LotteryResultLhc::findOne(array('qishu'=>$params['qishu']));
            if(!$saveData){
                return "找不到您要编辑的期数！";
            }
            $update = 1;
        }
        if(isset($params['qishu_query']) && $params['qishu_query']){
            $qishu = $params['qishu_query'];
        }
        $schedule = LotteryResultLhc::find();
        if($qishu){
            $schedule->where(array('qishu'=>$qishu));
        }
        $pages = new Pagination(['totalCount' =>$schedule->count(), 'pageSize' => $this->pageSize]);
        $list = $schedule->offset($pages->offset)->limit($pages->limit)->orderBy(['create_time'=>SORT_DESC])->asArray()->all();
        return $this->render('result',array(
            'list'=>$list,
            'pages'=>$pages,
            'qishu_query'=>$qishu,
            'saveData'=>$saveData,
            'update'=>$update
        ));
    }
	/**
	 * 极速六合彩期数修改记录
	 */
	public function actionResultLog()
	{
		$list = array();
		$id = $this->getParam('id',0);
		if($id){
			$list = LotteryResultLhc::findOne(array('id'=>trim($id)));
			if(empty($list)){
				return "找不到您要查看的期数!";
			}else{
				if($list->prev_text){
					return $list->prev_text;
				}
				return '该记录未被修改!';
			}
		}else{
			return "找不到您要查看的期数!";
		}
	}

    /**
     * 删除极速六合彩开奖记录
     */
    public function actionResultDelete(){
	    $id=$this->getParam('id',0);
	    if(!empty($id)){
            $result = LotteryResultLhc::findOne(array('id'=>trim($id)))->delete();
            if($result){
                return $this->out(true,'删除成功');
            }else{
                return $this->out(false.'删除失败');
            }
        }else{
	        return $this->out(false,'请求的记录不存在');
        }
    }

	/**
	 * 极速六合彩注单结算
	 */
	public function actionDoState(){
		$code = array('结算成功','重算成功','部分结算成功','部分重算成功','结算失败','重算失败','无效的参数','期数修改失败','注单不存在','正在结算中');
        $code[-1]='结算接口连接失败';
		$qishu = $this->getParam('qi','');
		$jsType = $this->getParam('jsType',0);
//        $qishu_result = LotteryResultLhc::findOne(array('qishu'=>$qishu));
//        if($qishu_result['type']==1){
//            return '已经在结算中，请稍后再试';
//        }
//        $qishu_result['type']=1;//把状态修改为结算中
//        $qishu_result->save();
		$arssClient = new ARSSClient();
		$result = $arssClient->LhcOrderSettle($qishu,$jsType,0);
//        $qishu_result['type']=0;//把状态修改为正常
//        $qishu_result->save();
		if(isset($code[$result]) && $code[$result]){
			return $code[$result];
		}else{
			return '结算有误，请稍后再试';
		}
	}

	/*
	 * 极速六合彩注单(按注单)
	* @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
	* @$userId 用户名
	* @$orderSubNum  子订单ID
	 */
	public function actionOrderByid(){

		$userId = $this->getParam('user_id',0);
		$orderNum = $this->getParam('order_num',0);
		$type = $this->getParam('type','');

		$result = SpsixLotteryOrder::getOrderByOrderid($userId,$orderNum,$type);
		$pages = new Pagination(['totalCount' =>count($result->asArray()->all()), 'pageSize' => $this->pageSize]);
		$list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();

		return $this->render('orderByid',array(
			'status'=>$this->status,
			'list' => $list,
			'pages' => $pages,
		));
	}


    /*
 * 极速六合彩-特码
 */

    public function actionTema() {
        $params = Yii::$app->request->get();
        $qishus = SpsixLotterySchedule::find()->select(array('qishu'))->groupBy(array('qishu'))->orderBy(array('create_time' => SORT_DESC))->asArray()->all();
        $orders = array('number' => '号码', 'bet_money' => '投注额');
        $order = isset($params['order']) && $params['order'] ? $params['order'] : 'number';
        $qishu = isset($params['qishu']) && $params['qishu'] ? $params['qishu'] : SpsixLotterySchedule::getNewQishu();
        $data = SpsixLotteryOrder::tema($qishu, $order);
        return $this->render('tema', array(
            'data' => $data,
            'order' => $order,
            'qishu' => $qishu,
            'qishus' => $qishus,
            'orders' => $orders
        ));
    }

}

