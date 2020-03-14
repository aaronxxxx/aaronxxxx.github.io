<?php
namespace app\modules\spsix\services;
use app\common\base\BaseService;
use app\modules\spsix\models\SpsixLotteryOrder;
use app\modules\spsix\models\SpsixLotteryOrderSub;

/**
 * Created by PhpStorm.
 * User: jhh
 * Date: 2016/12/28
 * Time: 14:08
 * 极速六合彩报表明细
 */
class SpSixReportService extends BaseService {
    /**
     * 极速六合彩报表明细 汇总
     * @param array $userInArray
     * @param string $startTime
     * @param string $endTime
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public function sixDetail( $userInArray=array(),$startTime='',$endTime='',$page=0,$pageSize=20){
        $list = SpsixLotteryOrder::sixDetail($startTime, $endTime, $userInArray);
        $count =  $list->count();
        //$count = count($list->asArray()->all());
        $data = $list->offset($page)->limit($pageSize)->asArray()->all();
        $data[0]['bet_money'] = !empty($data[0]['bet_money'])?$data[0]['bet_money']:0;
        $data[0]['is_win_total'] = !empty($data[0]['is_win_total'])?$data[0]['is_win_total']:0;
        $result['data'] = $data;
        $result['count']=!empty($count)?$count:0;//总数据条数
        return $result;
    }
    /**
     * 极速六合彩报表明细 按用户查询
     * @$user 用户名 单个用户时
     * $userInArray 包含多个用户时  数组
     * $userNinArray   忽略的多个用户时  数组
     * $startTime 开始时间 时间格式 如 2016-12-29 00:00:00
     * $endTime结束时间 如 2016-12-29 00:00:00
     * $group 分组排序 $group=num或者 $group=user就是按用户查询
     * $page 分页页码
     * $pageSize每页显示条数
     * 返回结果 data是数据结果集
     * count 总数据条数
     */
    public function sixDetailUser( $userInArray=array(),$startTime='',$endTime='',$page=0,$pageSize=20){
        $list = SpsixLotteryOrder::sixDetail($startTime, $endTime, $userInArray,'user');
        $count =  $list->count();
        //$count = count($list->asArray()->all());
        $data = $list->offset($page)->limit($pageSize)->asArray()->all();
        $result['data'] = $data;
        $result['count']=$count;//总数据条数
        return $result;
    }

    /**
     * 极速六合彩报表明细 按订单查询
     * @param array $userInArray
     * @param string $startTime
     * @param string $endTime
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public function sixDetailNum( $userInArray=array(),$startTime='',$endTime='',$page=0,$pageSize=20){
        $list = SpsixLotteryOrder::sixDetail($startTime, $endTime, $userInArray,'num');
        $count =  $list->count();
        //$count = count($list->asArray()->all());
        $data = $list->offset($page)->limit($pageSize)->asArray()->all();
        $result['data'] = $data;
        $result['count']=$count;//总数据条数
        return $result;
    }
    /**
     * 获取和局总金额
     * @param $userInArray
     * @param string $startTime
     * @param string $endTime
     */
    public function sixDrawSum($userid,$startTime='',$endTime=''){
           $data = SpsixLotteryOrder::getDrawSum($userid,$startTime,$endTime);
           $result =$data->asArray()->one();
           if(empty($result['draw_total_money'])){
               $result['draw_total_money']=0;
           }
           return $result['draw_total_money'];
    }

    /**
     * 获取有效下注总金额
     * @param $userid
     * @param string $startTime
     * @param string $endTime
     */
    public function sixTotalBetMoney($userid,$startTime='',$endTime=''){
            $data = SpsixLotteryOrderSub::getTotalBetMoney($userid,$startTime,$endTime);
            return $data;
    }
}
