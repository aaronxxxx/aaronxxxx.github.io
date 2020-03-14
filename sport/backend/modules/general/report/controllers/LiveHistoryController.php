<?php
namespace app\modules\general\report\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use app\modules\general\report\models\UserList;

/**
 * Default controller for the `report` module
 */
class LiveHistoryController extends BaseController{

    public function actionIndex(){
        ini_set('max_execution_time','0');
        $this->layout = false;
        $getDatas = Yii::$app->request->get();
        if(!isset($getDatas['user_group'])){ $getDatas['user_group'] = '';}
        if(!isset($getDatas['user_ignore_group'])){ $getDatas['user_ignore_group'] = '';}
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        //获取用户名和忽略用户名查询到的用户id
        $s_time = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $e_time = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        if($userNames[0] == '' && $userIgnoreName[0] == ''){
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
        $service = ServiceFactory::get('live', 'liveReportService');
        $live_result = $service->loadLiveAndGameResult($s_time, $e_time, $userIds);
        $zr_result = $live_result['zr_result'];
        $zc_result = $live_result['zc_result'];
        $zr_result_agin = $live_result['zr_result_agin'];
        $zc_result_agin = $live_result['zc_result_agin'];
        $zr_result_bbin = $live_result['zr_result_bbin'];
        $zc_result_bbin = $live_result['zc_result_bbin'];
        $zr_result_ds = $live_result['zr_result_ds'];
        $zc_result_ds = $live_result['zc_result_ds'];
        $zr_result_mg = $live_result['zr_result_mg'];
        $zc_result_mg = $live_result['zc_result_mg'];
        $zr_result_og = $live_result['zr_result_og'];
        $zc_result_og = $live_result['zc_result_og'];
        $zr_result_ag_og = $live_result['zr_result_ag_og'];
        $zc_result_ag_og = $live_result['zc_result_ag_og'];
        $zr_result_kg = $live_result['zr_result_kg'];
        $zc_result_kg = $live_result['zc_result_kg'];
        $zr_result_vr = $live_result['zr_result_vr'];
        $zc_result_vr = $live_result['zc_result_vr'];
        $zr_result_pt = $live_result['zr_result_pt'];
        $zc_result_pt = $live_result['zc_result_pt'];
        $zr_result_ai = $live_result['zr_result_ai'];
        $zc_result_ai = $live_result['zc_result_ai'];
        $total_bet_count = $live_result['total_bet_count'];
        $total_bet_money = $live_result['total_bet_money'];
        return $this->render('index', [
            's_time'=>$s_time,
            'e_time'=>$e_time,
            'user_group'=>$getDatas['user_group'],
            'user_ignore_group'=>$getDatas['user_ignore_group'],
            'zr_result'=>$zr_result,
            'zc_result'=>$zc_result,
            'zr_result_agin'=>$zr_result_agin,
            'zc_result_agin'=>$zc_result_agin,
            'zr_result_bbin'=>$zr_result_bbin,
            'zc_result_bbin'=>$zc_result_bbin,
            'zr_result_ds'=>$zr_result_ds,
            'zc_result_ds'=>$zc_result_ds,
            'zr_result_mg'=>$zr_result_mg,
            'zc_result_mg'=>$zc_result_mg,
            'zr_result_og'=>$zr_result_og,
            'zc_result_og'=>$zc_result_og,
            'zr_result_ag_og'=>$zr_result_ag_og,
            'zc_result_ag_og'=>$zc_result_ag_og,
            'zr_result_kg'=>$zr_result_kg,
            'zc_result_kg'=>$zc_result_kg,
            'zr_result_vr'=>$zr_result_vr,
            'zc_result_vr'=>$zc_result_vr,
            'zr_result_pt'=>$zr_result_pt,
            'zc_result_pt'=>$zc_result_pt,
            'zr_result_ai'=>$zr_result_ai,
            'zc_result_ai'=>$zc_result_ai,
            'total_bet_count'=>$total_bet_count,
            'total_bet_money'=>$total_bet_money,
        ]);
    }
}
