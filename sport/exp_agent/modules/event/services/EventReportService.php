<?php
namespace app\modules\event\services;
use app\common\base\BaseService;
use app\modules\agentht\models\EventOrder;

/**
 * Created by PhpStorm.
 * User: jhh
 * Date: 2016/12/28
 * Time: 14:08
 * 賽事报表明细
 */
class EventReportService extends BaseService {
    /**
     * 賽事报表明细 汇总
     * @param array $userInArray
     * @param string $startTime
     * @param string $endTime
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public function eventDetail( $userInArray=array(),$startTime='',$endTime='',$page=0,$pageSize=20){
        $list = EventOrder::eventDetail($startTime, $endTime, $userInArray);
        $count =  $list->count();
        //$count = count($list->asArray()->all());
        $data = $list->offset($page)->limit($pageSize)->asArray()->all();
        $data[0]['bet_money'] = !empty($data[0]['bet_money'])?$data[0]['bet_money']:0;
        $data[0]['is_win_total'] = !empty($data[0]['is_win_total'])?$data[0]['is_win_total']:0;
        $result['data'] = $data;
        $result['count']=!empty($count)?$count:0;//总数据条数
        return $result;
    }
}
