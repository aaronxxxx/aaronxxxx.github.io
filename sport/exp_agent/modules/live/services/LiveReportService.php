<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/28
 * Time: 15:07
 */

namespace app\modules\live\services;

use app\common\base\BaseService;
use app\modules\live\models\LiveLog;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;
use Yii;

class LiveReportService extends BaseService
{
    /**
     * 报表明细
     * @param $startTime
     * @param $endTime
     * @param $userIds
     * @return array
     */
    public function loadReportResult($startTime, $endTime, $userIds) {
        $liveNames = LiveUser::getLiveUserNameByUserId($userIds);
        $sxzr_result = LiveOrder::getLiveOrderResult(0, $liveNames, $startTime, $endTime);
        $dzyy_result = LiveOrder::getLiveOrderResult(1, $liveNames, $startTime, $endTime);
        if ($sxzr_result["bet_count"] == 0) {
            $sxzr_result["bet_count"] = $sxzr_result["valid_bet_amount"] = $sxzr_result["bet_money"] = $sxzr_result["live_win"] = 0;
        }
        if ($dzyy_result["bet_count"] == 0) {
            $dzyy_result["bet_count"] = $dzyy_result["valid_bet_amount"] = $dzyy_result["bet_money"] = $dzyy_result["live_win"] = 0;
        }
        $zr_result = LiveLog::getBetMoneyAndCount($startTime, $endTime, "All", "转入", $userIds);
        $zc_result = LiveLog::getBetMoneyAndCount($startTime, $endTime, "All", "转出", $userIds);
        if ($zr_result["bet_count"] == 0 && $zc_result["bet_count"] == 0) {
            $zz_result["bet_count"] = $zz_result["zr"] = $zz_result["zc"] = $zz_result["win"] = 0;
        }else{
            $zz_result["bet_count"] = $zr_result["bet_count"]+$zc_result["bet_count"];
            $zz_result["zr"] = $zr_result["bet_money"];
            $zz_result["zc"] = $zc_result["bet_money"];
            $zz_result["win"] = $zr_result["bet_money"] - $zc_result["bet_money"];
        }
        return [
            'sxzr_result' => $sxzr_result,
            'dzyy_result' => $dzyy_result,
            'zz_result' => $zz_result
        ];
    }

    /**
     * 真人和游艺明细
     * @param $startTime
     * @param $endTime
     * @param $userIds
     * @return array
     */
    public function loadLiveAndGameResult($startTime, $endTime, $userIds) {
        $userIdsStr = $this->_convertUserIdsToStr($userIds);
        $zr_result = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG", "转入", $userIdsStr);
        $zc_result = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG", "转出", $userIdsStr);
        $zr_result_agin = $this->_loadBetMoneyAndCount($startTime, $endTime, "AGIN", "转入", $userIdsStr);
        $zc_result_agin = $this->_loadBetMoneyAndCount($startTime, $endTime, "AGIN", "转出", $userIdsStr);
        $zr_result_bbin = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_BBIN", "转入", $userIdsStr);
        $zc_result_bbin = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_BBIN", "转出", $userIdsStr);
        $zr_result_ds = $this->_loadBetMoneyAndCount($startTime, $endTime, "DS", "转入", $userIdsStr);
        $zc_result_ds = $this->_loadBetMoneyAndCount($startTime, $endTime, "DS", "转出", $userIdsStr);
        $zr_result_mg = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_MG", "转入", $userIdsStr);
        $zc_result_mg = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_MG", "转出", $userIdsStr);
        $zr_result_ag_og = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_OG", "转入", $userIdsStr);
        $zc_result_ag_og = $this->_loadBetMoneyAndCount($startTime, $endTime, "AG_OG", "转出", $userIdsStr);
        $zr_result_og = $this->_loadBetMoneyAndCount($startTime, $endTime, "OG", "转入", $userIdsStr);
        $zc_result_og = $this->_loadBetMoneyAndCount($startTime, $endTime, "OG", "转出", $userIdsStr);
        $zr_result_kg = $this->_loadBetMoneyAndCount($startTime, $endTime, "KG", "转入", $userIdsStr);
        $zc_result_kg = $this->_loadBetMoneyAndCount($startTime, $endTime, "KG", "转出", $userIdsStr);
        $total_bet_count = $zr_result["bet_count"] + $zc_result["bet_count"] + $zr_result_agin["bet_count"] + $zc_result_agin["bet_count"]
                            + $zr_result_bbin["bet_count"] + $zc_result_bbin["bet_count"]+$zr_result_ds["bet_count"] + $zc_result_ds["bet_count"]
                            + $zr_result_mg["bet_count"] + $zc_result_mg["bet_count"]+$zr_result_ag_og["bet_count"] + $zc_result_ag_og["bet_count"]+$zr_result_og["bet_count"] + $zc_result_og["bet_count"]+$zr_result_kg["bet_count"] + $zc_result_kg["bet_count"];
        $total_bet_money = $zr_result["bet_money"] - $zc_result["bet_money"] + $zr_result_agin["bet_money"] - $zc_result_agin["bet_money"]
                            + $zr_result_bbin["bet_money"] - $zc_result_bbin["bet_money"]+$zr_result_ds["bet_money"] - $zc_result_ds["bet_money"]
                            + $zr_result_mg["bet_money"] - $zc_result_mg["bet_money"]+$zr_result_ag_og["bet_money"] - $zc_result_ag_og["bet_money"]+$zr_result_og["bet_money"] - $zc_result_og["bet_money"]+$zr_result_kg["bet_money"] - $zc_result_kg["bet_money"];
        return [
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
            'zr_result_ag_og'=>$zr_result_ag_og,
            'zc_result_ag_og'=>$zc_result_ag_og,
            'zr_result_og'=>$zr_result_og,
            'zc_result_og'=>$zc_result_og,
            'zr_result_kg'=>$zr_result_kg,
            'zc_result_kg'=>$zc_result_kg,
            'total_bet_count'=>$total_bet_count,
            'total_bet_money'=>$total_bet_money,
        ];
    }

    private function _convertUserIdsToStr($userIds) {
        $userIdsStr = '';
        if(count($userIds) > 0) {
            foreach($userIds as $key => $value){
                $userIdsStr .= "'".$value["user_id"]."'".",";
            }
            $userIdsStr = "(".substr($userIdsStr, 0, -1).")";
        } else {
            $userIdsStr = "('')";
        }
        return $userIdsStr;
    }

    private function _loadBetMoneyAndCount($dayStart, $dayEnd, $gType, $rType, $userIdsStr) {
        $oneDayStart = $dayStart . ' 00:00:00';
        $oneDayEnd = $dayEnd . ' 23:59:59';
        $sql_where = "";
        if ($gType == "AG" || $gType == "AGIN" || $gType == "AG_BBIN" || $gType == "AG_MG" ||$gType == "DS" || $gType == "AG_OG") {
            $sql_where.=" and live_type='" . $gType . "'";
        }
        if ($gType == "AG") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='1')";
            } elseif ($rType == "转出") {
                $sql_where.=" and (zz_type='2')";
            }
        } elseif ($gType == "AGIN") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='3')";
            } elseif ($rType == "转出") {
                $sql_where.=" and (zz_type='4')";
            }
        } elseif ($gType == "AG_BBIN") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='5') ";
            } elseif ($rType == "转出") {
                $sql_where.=" and (zz_type='6') ";
            }
        }elseif ($gType == "DS") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='7') ";
            } elseif ($rType == "转出") {
                $sql_where.=" and (zz_type='8') ";
            }
        }  elseif ($gType == "AG_MG") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='11') ";
            } elseif ($rType == "转出") {
                $sql_where.=" and (zz_type='12') ";
            }
        } elseif ($gType == "AG_OG") {
            if ($rType == "转入") {
                $sql_where.=" and zz_type='9' ";
            } elseif ($rType == "转出") {
                $sql_where.=" and zz_type='10' ";
            }
        } elseif ($gType == "OG") {
            if ($rType == "转入") {
                $sql_where.=" and zz_type='13' ";
            } elseif ($rType == "转出") {
                $sql_where.=" and zz_type='14' ";
            }
        } elseif ($gType == "KG") {
            if ($rType == "转入") {
                $sql_where.=" and zz_type='15' ";
            } elseif ($rType == "转出") {
                $sql_where.=" and zz_type='16' ";
            }
        }
        if ($gType == "All") {
            if ($rType == "转入") {
                $sql_where.=" and (zz_type='1' or zz_type='3' or zz_type='5' or zz_type='7' or zz_type='9' or zz_type='11' or zz_type='13' or zz_type='15')";
            } else{
                $sql_where.=" and (zz_type='2' or zz_type='4' or zz_type='6' or zz_type='8' or zz_type='10' or zz_type='12' or zz_type='14' or zz_type='16')  ";
            }
        }
        $sql = "SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(zz_money,0)),0) AS bet_money FROM live_log WHERE result like '%[成功]%' AND add_time>= '" . $oneDayStart . "' AND add_time<='" . $oneDayEnd . "' $sql_where AND user_id IN $userIdsStr LIMIT 0,1";
        return Yii::$app->db->createCommand($sql)->queryOne();
    }
}