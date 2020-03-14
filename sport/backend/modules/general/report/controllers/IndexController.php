<?php

namespace app\modules\general\report\controllers;

use yii;
use yii\helpers\ArrayHelper;
use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use app\modules\general\report\models\UserList;

/**
 * Default controller for the `report` module
 */
class IndexController extends BaseController {

    public function init() {
        parent::init();
        $this->layout = false;
    }

    /**
     * 报表明细
     * @return type
     */
    public function actionIndex() {
        ini_set('max_execution_time','0');
        $ids = [];
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
            //会员最后操作时间大于查询起始时间的会员ID
               
            /*20180301@robin modify onlinetime >= '$s_time' => logintime >= '$s_time' AND　logintime <= '$e_time' */
            /*20180724@yang update $userIds = UserList::find()->select('user_id')->where("logintime >= '$s_time'")->asArray()->all();*/ 
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            
            $userIds = UserList::find()->select('user_id')->where(['not in', 'user_id', $ExcludeGroup])->asArray()->all();
			//$userIds = [];      //20180301@robin mark
        }else{
            $sql = "SELECT ul.user_id 
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            $userIds = UserList::getUserIdByUserName2($userNames,$userIgnoreName,$ExcludeGroup);
        }
		
        foreach ($userIds as $value) {
            array_unshift($ids,$value['user_id']);
        }
        $service = ServiceFactory::get('live', 'liveReportService');
        $live_result = $service->loadReportResult($time['s_time'], $time['e_time'], $ids);
        $sxzr_result = $live_result['sxzr_result'];
        $dzyy_result = $live_result['dzyy_result'];
        $zz_result = $live_result['zz_result'];
        $pe_result = $live_result['pe_result'];

        

		$service = ServiceFactory::get('lottery', 'lotteryorderReportService');
		//$lottery_result = $service->lotteryCount($time['s_time'], $time['e_time'],$ids);        //20180301@robin mark
        $lottery_result = $service->lottery($ids, $time['s_time'], $time['e_time']);              //20180301@robin add
		//$lottery_list['bet_count'] = $lottery_result[1]['bet_count'];                           //20180301@robin mark
		//$lottery_list['bet_money'] = $lottery_result[1]['bet_money'];                           //20180301@robin mark
		//$lottery_list['win_money'] = $lottery_result[0];                                        //20180301@robin mark
		//$lottery_list['result'] = $lottery_result[1]['bet_money'] - $lottery_list['win_money']; //20180301@robin mark
		
		$lottery_list['bet_count'] = $lottery_result[0]['all_count'];
		$lottery_list['bet_money'] = $lottery_result[0]['all_money'];
		$lottery_list['win_money'] = $lottery_result[0]['all_win'];
		$lottery_list['result'] = $lottery_result[0]['all_result'];
	
        $service = ServiceFactory::get('six', 'sixReportService');
        $six_result = $service->sixDetail($ids,$time['s_time'], $time['e_time']);
        $six_list['bet_count'] = $six_result['data'][0]['count_total'];
        $six_list['bet_money'] = $six_result['data'][0]['bet_money'];
        $six_list['win_money'] = $six_result['data'][0]['is_win_total'];
        $six_list['result'] = $six_list['bet_money'] - $six_list['win_money'] ;

        $service = ServiceFactory::get('spsix', 'spsixReportService');
        $spsix_result = $service->sixDetail($ids,$time['s_time'], $time['e_time']);
        $spsix_list['bet_count'] = $spsix_result['data'][0]['count_total'];
        $spsix_list['bet_money'] = $spsix_result['data'][0]['bet_money'];
        $spsix_list['win_money'] = $spsix_result['data'][0]['is_win_total'];
        $spsix_list['result'] = $spsix_list['bet_money'] - $spsix_list['win_money'] ;

        $all1['bet_count'] = $six_list['bet_count'] + $lottery_list['bet_count'] +  $spsix_list['bet_count'];
        $all1['bet_money'] = $six_list['bet_money'] + $lottery_list['bet_money'] +  $spsix_list['bet_money'];
        $all1['win_money'] = $six_list['win_money'] + $lottery_list['win_money'] +  $spsix_list['win_money'];
        //$all1['result'] = $all1['bet_money'] - $all1['win_money'];           //20180301@robin mark
        $all1['result'] =  $lottery_list['result'] + $six_list['result'] + $spsix_list['result'];

 


        return $this->render('index', [
                    'time' => $time,
                    'user_group' => $getDatas['user_group'],
                    'user_ignore_group' => $getDatas['user_ignore_group'],
                    'lottery_list' => $lottery_list,
                    'six_list' => $six_list,
                    'spsix_list' => $spsix_list,
                    'sxzr_result'=>$sxzr_result,
                    'dzyy_result'=>$dzyy_result,
                    'zz_result'=>$zz_result,
                    'pe_result'=>$pe_result,
                    'all1' => $all1,
        ]);
    }

}
