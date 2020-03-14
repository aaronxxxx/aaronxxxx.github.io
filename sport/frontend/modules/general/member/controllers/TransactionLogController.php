<?php

namespace app\modules\general\member\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\general\member\models\BankTransaction\Money;
use app\modules\general\member\models\TransactionLog\LiveLog;

/**
 * 交易记录-存取款记录
 * TransactionLogController
 */
class TransactionLogController extends BaseController {
    private $_req = null;
    private $_session = null;
    private $_params = null;
    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;

        $this->getView()->title = '交易记录';
        $this->layout = 'main';
    }

    /**
     * 存取汇款记录(在线存款记录，在线汇款记录，在线取款记录，额度转换)
     * 根据前端四种不同的参数，展示存取汇三种不同的数据以及真人额度转换数据
     * @return string
     */
    public function actionBank() {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $arr1['type'] = $arr1['order_num'] = '';
        $arr = array();
        if (empty($getNews['type'])) {//在线存款记录
            $rows = $this->_cunkuan($user_group);
            $arr = $rows[0];
            $arr1 = $rows[1];
            $pages = $rows[2];
        }
        else if ($getNews['type'] == 'hk') {//在线汇款记录
            $rows = $this->_huikuan($user_group);
            $arr = $rows[0];
            $arr1 = $rows[1];
            $pages = $rows[2];
        }
        else if ($getNews['type'] == 'qk') {//在线取款记录
            $rows = $this->_qukuan($user_group);
            $arr = $rows[0];
            $arr1 = $rows[1];
            $pages = $rows[2];
        }
        else if ($getNews['type'] == 'zz') {//额度转换
            $rows = $this->_zz($user_group);
            $arr = $rows[0];
            $arr1 = $rows[1];
            $pages = $rows[2];
        }
        return $this->render('bank', ['arr' => $arr, 'arr1' => $arr1, 'pages' => $pages]);
    }

    /**
     * 额度转换取消转账
     */
    public function actionRollback() {
        $postNews = Yii::$app->request->post();
        $live_id = $postNews['live_id'];
        $change_type = $postNews['change_type'];
        $live_type = $postNews['live_type'];
        $row = LiveLog::getNewsById($live_id);//获取该条信息
        if ($row && ($row["status"] == 0 || $row["status"] == 4)) {// 只针对平台转入娱乐厅处理
            $about = '';
            if ($change_type == "1" && $live_type == 'AG') {
                $about = "转入AG极速厅";
            } elseif ($change_type == "3" && $live_type == 'AGIN') {
                $about = "转入AG国际厅";
            } elseif ($change_type == "5" && $live_type == 'AG_BBIN') {
                $about = "转入AG BBIN厅";
            } elseif ($change_type == "7" && $live_type == 'DS') {
                $about = "转入DS厅";
            } elseif ($change_type == "9" && $live_type == 'AG_OG') {
                $about = "转入AG_OG厅";
            } elseif ($change_type == "11" && $live_type == 'AG_MG') {
                $about = "转入AG_MG厅";
            }
            LiveLog::updateNewsById($live_id,$about);
            return "取消成功";
        } else {
            return "取消失败";
        }
    }

    /**
     * 回去会员存款记录信息
     * @param $user_group   会员ID
     * @return array        [存款信息，分页]
     */
    private function _cunkuan($user_group) {
        $arr = array();
        $arr1['order_num'] = 0;
        $arr1['type'] = '';
        $rows = Money::getOnlineSeposit($user_group);
        $cunkuan_list = $rows[0];
        $pages = $rows[1];
        $sum = 0;
        if ($cunkuan_list && count($cunkuan_list) > 0) {
            $arr1['order_num'] = 1;
            foreach ($cunkuan_list as $key => $cunkuan_info) {
                if ($cunkuan_info["status"] == "成功") {
                    $sum += $cunkuan_info["order_value"];
                    $statusString = '<span style="color:#FF0000;">成功</span>';
                } else if ($cunkuan_info["status"] == "失败") {
                    $statusString = '<span style="color:#000000;">失败</span>';
                } else {
                    $statusString = '<span style="color:#0000FF;">系统审核中</span>';
                }
                $cunkuan_list[$key]['statusString'] = $statusString;
            }
            $arr = $cunkuan_list;
        }
        return [$arr,$arr1,$pages];
    }
    /**
     * 回去会员汇款记录信息
     * @param $user_group   会员ID
     * @return array        [汇款信息，分页]
     */
    private function _huikuan($user_group){
        $arr = array();
        $arr1['order_num'] = 0;
        $arr1['type'] = 'hk';
        $rows = Money::getRemittanceRecords($user_group);
        $huikuan_list = $rows[0];
        $pages = $rows[1];
        if ($huikuan_list && count($huikuan_list) > 0) {
            $arr1['order_num'] = 1;
            foreach ($huikuan_list as $key => $value) {
                if ($value['status'] == '未结算') {
                    $huikuan_list[$key]['status'] = '系统审核中';
                } elseif($value['status'] == '失败') {
                    $huikuan_list[$key]['status'] = '交易失败';
                }elseif($value['status'] == '成功'){
                    $huikuan_list[$key]['status'] = '交易成功';
                }
            }
            $arr = $huikuan_list;
        }
        return [$arr,$arr1,$pages];
    }
    /**
     * 回去会员取款记录信息
     * @param $user_group   会员ID
     * @return array        [取款信息，分页]
     */
    private function _qukuan($user_group){
        $arr = array();
        $arr1['order_num'] = 0;
        $arr1['type'] = 'qk';
        $rows = Money::getWithdrawRecord($user_group);
        $qukuan_list = $rows[0];
        $pages = $rows[1];
        if ($qukuan_list && count($qukuan_list) > 0) {
            $arr1['order_num'] = 1;
            foreach ($qukuan_list as $key => $value) {
                if ($value['status'] == '未结算') {
                    $qukuan_list[$key]['status'] = '系统审核中';
                } else if($value['status'] == '失败'){
                    $qukuan_list[$key]['status'] = '交易失败';
                }else if($value['status'] == '成功'){
                    $qukuan_list[$key]['status'] = '交易成功';
                }
                $qukuan_list[$key]['order_value'] = 0 - $value['order_value'];
            }
            $arr = $qukuan_list;
        }
        return [$arr,$arr1,$pages];
    }
    /**
     * 回去会员额度转换记录信息
     * @param $user_group   会员ID
     * @return array        [额度转换信息，转入转出数据统计，分页]
     */
    private function _zz($user_group){
        $arr = $arr1 =  array();
        $arr1['type'] = 'zz';
        $arr1['order_num'] = '';
        $rows = LiveLog::getLifeRecordByUser($user_group);
        $zzkuan_list = $rows[0];
        $pages = $rows[1];
        if ($zzkuan_list && count($zzkuan_list) > 0) {
            $arr1['order_num'] = 1;
            $in_ag_total = $out_ag_total = $in_agin_total = $out_agin_total = $in_ag_bbin_total = $out_ag_bbin_total =0;
            $in_ds_total = $out_ds_total = $in_ag_og_total = $out_ag_og_total = $in_ag_mg_total = $out_ag_mg_total = 0;
            $in_og_total = $out_og_total = 0;
            $in_kg_total = $out_kg_total = 0;
            $in_vr_total = $out_vr_total = 0;
            foreach ($zzkuan_list as $key => $userLive) {
                $live_type = $userLive["live_type"];
                $zzArray = $this->_getZztype($userLive["zz_type"], $userLive["live_type"],$userLive["result"],$userLive["zz_money"]);
                $cancel_button = "";
                if ($userLive["status"] == "0" || $userLive["status"] == "4") {
                    $cancel_button = '<input type="button" value="取消转账" onclick="rollbackDeal(\'' . $userLive["id"] . '\',\'' . $userLive["zz_type"] . '\',\'' . $live_type . '\')"/>';
                }
                $in_ag_total += $zzArray[1];
                $out_ag_total += $zzArray[2];
                $in_agin_total += $zzArray[3];
                $out_agin_total += $zzArray[4];
                $in_ag_bbin_total += $zzArray[5];
                $out_ag_bbin_total += $zzArray[6];
                $in_ds_total += $zzArray[7];
                $out_ds_total += $zzArray[8];
                $in_ag_og_total += $zzArray[9];
                $out_ag_og_total += $zzArray[10];
                $in_ag_mg_total += $zzArray[11];
                $out_ag_mg_total += $zzArray[12];
                $in_og_total += $zzArray[13];
                $out_og_total += $zzArray[14];
                $in_kg_total += $zzArray[15];
                $out_kg_total += $zzArray[16];
                $in_vr_total +=$zzArray[17];
                $out_vr_total +=$zzArray[18];
                $zzkuan_list[$key]['zz_type'] = $zzArray[0];
                $zzkuan_list[$key]['cancel_button'] = $cancel_button;
            }
            $arr = $zzkuan_list;
            $arr1['in_ag_total'] = $in_ag_total;
            $arr1['out_ag_total'] = $out_ag_total;
            $arr1['in_agin_total'] = $in_agin_total;
            $arr1['out_agin_total'] = $out_agin_total;
            $arr1['in_ag_bbin_total'] = $in_ag_bbin_total;
            $arr1['out_ag_bbin_total'] = $out_ag_bbin_total;
            $arr1['in_ds_total'] = $in_ds_total;
            $arr1['out_ds_total'] = $out_ds_total;
            $arr1['in_ag_og_total'] = $in_ag_og_total;
            $arr1['out_ag_og_total'] = $out_ag_og_total;
            $arr1['in_ag_mg_total'] = $in_ag_mg_total;
            $arr1['out_ag_mg_total'] = $out_ag_mg_total;
            $arr1['in_og_total'] = $in_og_total;
            $arr1['out_og_total'] = $out_og_total;
            $arr1['in_kg_total'] = $in_kg_total;
            $arr1['out_kg_total'] = $out_kg_total;
            $arr1['in_vr_total'] = $in_vr_total;
            $arr1['out_vr_total'] = $out_vr_total;
        }
        return [$arr,$arr1,$pages];
    }

    static public function _getZztype($zz_type,$live_type,$result,$money){
        $in_ag_total = $out_ag_total = $in_agin_total = $out_agin_total = $in_ag_bbin_total = $out_ag_bbin_total =0;
        $in_ds_total = $out_ds_total = $in_ag_og_total = $out_ag_og_total = $in_ag_mg_total = $out_ag_mg_total = 0;
        $in_og_total = $out_og_total = 0;
        $in_kg_total = $out_kg_total = 0;
        $in_vr_total = $out_vr_total = 0;
        if ($zz_type == "1" && $live_type == 'AG') {
            $zz_type = "转入AG极速厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_total += $money;
            }
        }elseif ( $zz_type == "2" && $live_type ==  'AG') {
            $live_type =  'AG';
            $zz_type = "从AG极速厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_total += $money;
            }
        }
        if ($zz_type == "3" && $live_type == 'AGIN') {
            $live_type = 'AGIN';
            $zz_type = "转入AG国际厅";
            if (strpos($result, "[成功]") !== false) {
                $in_agin_total += $money;
            }
        } elseif ($zz_type == "4" && $live_type == 'AGIN') {
            $live_type = 'AGIN';
            $zz_type = "从AG国际厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_agin_total += $money;
            }
        }
        if ($zz_type == "5" && $live_type == 'AG_BBIN') {
            $live_type = 'AG_BBIN';
            $zz_type = "转入AG BBIN厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_bbin_total += $money;
            }
        } elseif ($zz_type == "6" && $live_type == 'AG_BBIN') {
            $live_type = 'AG_BBIN';
            $zz_type = "从AG BBIN厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_bbin_total += $money;
            }
        }
        if ($zz_type == "7" && $live_type == 'DS') {
            $live_type = 'DS';
            $zz_type = "转入DS厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ds_total += $money;
            }
        } elseif ($zz_type == "8" && $live_type == 'DS') {
            $live_type = 'DS';
            $zz_type = "从DS厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ds_total += $money;
            }
        }
        if ($zz_type == "9" && $live_type == 'AG_OG') {
            $live_type = 'AG_OG';
            $zz_type = "转入AG OG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_og_total += $money;
            }
        } elseif ($zz_type == "10" && $live_type == 'AG_OG') {
            $live_type = 'AG_OG';
            $zz_type = "从AG OG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_og_total += $money;
            }
        }
        if ($zz_type == "11" && $live_type == 'AG_MG') {
            $zz_type = "转入AG MG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_mg_total += $money;
            }
        } elseif ($zz_type == "12" && $live_type == 'AG_MG') {
            $zz_type = "从AG MG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_mg_total += $money;
            }
        }
        if ($zz_type == "13" && $live_type == 'OG') {
            $zz_type = "转入OG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_og_total += $money;
            }
        } elseif ($zz_type == "14" && $live_type == 'OG') {
            $zz_type = "从OG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_og_total += $money;
            }
        }
        if ($zz_type == "15" && $live_type == 'KG') {
            $zz_type = "转入KG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_kg_total += $money;
            }
        } elseif ($zz_type == "16" && $live_type == 'KG') {
            $zz_type = "从KG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_kg_total += $money;
            }
        }
        if ($zz_type == "19" && $live_type == 'VR') {
            $zz_type = "转入VR厅";
            if (strpos($result, "[成功]") !== false) {
                $in_vr_total += $money;
            }
        } elseif ($zz_type == "20" && $live_type == 'VR') {
            $zz_type = "从VR厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_vr_total += $money;
            }
        }

        return array($zz_type,$in_ag_total,$out_ag_total,$in_agin_total,$out_agin_total,$in_ag_bbin_total,$out_ag_bbin_total
        ,$in_ds_total,$out_ds_total,$in_ag_og_total,$out_ag_og_total,$in_ag_mg_total,$out_ag_mg_total,$in_og_total,$out_og_total,$in_kg_total,$out_kg_total,$in_vr_total,$out_vr_total);
    }
}
