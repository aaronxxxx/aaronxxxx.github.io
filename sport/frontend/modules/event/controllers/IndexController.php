<?php
namespace app\modules\event\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\event\models\EventOfficial;
use app\modules\event\models\EventPlayer;
use app\modules\event\models\EventTwopk;
use app\modules\event\models\EventTwopkOdds;
use app\modules\event\models\EventTwopkOddsLog;
use app\modules\event\models\EventMultiple;
use app\modules\event\models\EventMultipleOdds;
use app\modules\event\models\EventMultipleOddsLog;
use app\modules\event\models\EventOrder;
use app\modules\lottery\models\ar\UserGroup;
use app\modules\lottery\models\ar\UserList;
use app\modules\lottery\helpers\DataValid;

/**
 * 新運彩
 * IndexController
 */
class IndexController extends BaseController
{
    const CONST_LOTTERY_TYPE = 'event';
    const CONST_LOTTERY_NAME = '新运彩';

    public function init()
    {
        $Lottery_set = parent::init();
        #维护判断
        if ($Lottery_set['close'] == '1') {
            $this->layout = 'main';
            echo $this->render ('lotteryclose',[
                'lotteryname'=>$Lottery_set['name'],
            ]); exit;
        }
        $this->enableCsrfValidation = false;    // 关闭csrf验证
        $this->layout = 'main';
    }

    public function actionIndex()
    {
        // 此頁內容全都由js將new.json的資料產出
    }

    public function actionInsertOrder()
    {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        $data = Yii::$app->request->post();
        $message = trim($data['message']);
        unset($data['message']);

        // 效验数据
        $ret = $this->data_valid($data);
		if ($ret) {
			return json_encode($ret);
		}

        $innerTransaction = Yii::$app->db->beginTransaction();
        try {
            $userId = Yii::$app->session->get('uid');
            $game = $this->getOddsList($data['game_type'], $data['game_id'], $data['game_item_id']);
            $now = date("Y-m-d H:i:s");

			// 反水金额
            $userGroup = UserGroup::getUserGroupInfo($userId);
			$reb = $userGroup[strtolower(self::CONST_LOTTERY_TYPE) . '_bet_reb'];
			$fs = $data['bet_money'] * $reb;

            // 存入订单表
            $eventOrder = new EventOrder();
            $eventOrder->official_id = $game['official_id'];
            $eventOrder->game_id = $game['id'];
            $eventOrder->game_type = $data['game_type'];
            $eventOrder->title = $game['title'];
            $eventOrder->qishu = $game['qishu'];
            $eventOrder->user_id = $userId;
            $eventOrder->bet_time = $now;
            $eventOrder->bet_money = $data['bet_money'];
            $eventOrder->game_item_id = $data['game_item_id'];
            $eventOrder->bet_rate = $game['odds'];
            $eventOrder->bet_handicap = $game['handicap'];
            $eventOrder->win = $data['bet_money'] * $game['odds'];
            $eventOrder->fs = $fs;
            $eventOrder->message = $message;
            $eventOrder->create_time = $now;
            $eventOrder->save();

            // 再更新订单編號
            $orderNum = date('Ymd') . $eventOrder->id;
            $eventOrder = EventOrder::findOne($eventOrder->id);
            $eventOrder->order_num = $orderNum;
            $eventOrder->save();

            // 更新用戶金額
            $sum = $data['bet_money'];
            Yii::$app->db->createCommand(
                "update user_list set money = money - $sum where user_id = :id", [':id' => $userId]
            )->execute();

            // 用户投注日志
            $lotteryName = self::CONST_LOTTERY_NAME;
            $type = '彩票下注';
            $sql = "INSERT INTO
                        money_log(user_id, order_num, about, update_time, `type`, order_value, assets, balance)
                    SELECT
                        $userId as user_id,
                        $orderNum as order_num,
                        '$lotteryName' as about,
                        '$now' as update_time,
                        '$type' as `type`,
                        $sum as order_value,
                        money + $sum as assets,
                        money as balance
                    FROM
                        user_list
                    WHERE
                        user_id = $userId";
            Yii::$app->db->createCommand($sql)->execute();

            // 風控
            $this->risk($data, $game);

            $innerTransaction->commit();

            $valid = ["code" => 10];

            return json_encode($valid);
        } catch (Exception $e) {
            $innerTransaction->rollBack();

            error_log('IndexController.insert：'.$e->getTraceAsString().'online:'.$e->getLine().'，type：lzcqsf，time:'.date('Y-m-d h:i:s',time()).''."\r\n", 3, "error.log");
            $valid= ["code" => 8];

            return json_encode($valid);
        }
    }

    public function getOddsList($type, $id, $gameItemId)
    {
        if ($type ==  1) {
            $result = EventTwopk::getOne($id);

            // 讓分、賠率
            if ($gameItemId == $result['player1']) {
                $result['odds'] = $result['player1_odds'];

                if ($result['player1_handicap'] > 0) {
                    $result['handicap'] = '-' . $result['player1_handicap'];
                } elseif ($result['player2_handicap'] > 0) {
                    $result['handicap'] = $result['player2_handicap'];
                } else {
                    $result['handicap'] = 0;
                }
            } else {
                $result['odds'] = $result['player2_odds'];

                if ($result['player1_handicap'] > 0) {
                    $result['handicap'] = $result['player1_handicap'];
                } elseif ($result['player2_handicap'] > 0) {
                    $result['handicap'] = '-' . $result['player2_handicap'];
                } else {
                    $result['handicap'] = 0;
                }
            }

            // 標題
            $player1 = EventPlayer::find()
                ->where(['id' => $result['player1']])
                ->asArray()
                ->one();
            $player2 = EventPlayer::find()
                ->where(['id' => $result['player2']])
                ->asArray()
                ->one();

            $result['title'] = $player1['title'] . ' VS ' . $player2['title'];
        } else {
            $result = EventMultiple::getOne($id, $gameItemId);
            $result['handicap'] = '';
        }

        return $result;
    }

    public function data_valid($data)
    {
        $data_valid = new DataValid();

        $flag = $this->dataCheck($data);
        if (!$flag) {
            return ["code" => 8, "msg" => '错误的下注资讯!'];
        }

        $flag = $data_valid->data_except_valid([$data['bet_money']]);
        if (!$flag) {
            return ["code" => 8, "msg" => '请输入有效金额!'];
        }

        $flag = $this->bet_scope_limit($data, self::CONST_LOTTERY_TYPE);
        if (!$flag) {
            return ["code" => 8, "msg" => '注单金额受限!'];
        }

        $flag = $this->user_money_limit($data['bet_money']);
        if (!$flag) {
            return ["code" => 8, "msg" => '账户余额不足!'];
        }

        $flag = $this->bet_time_limit();
        if (!$flag) {
            return ["code" => 8, "msg" => '已经封盘了，超出了投注时间!'];
        }

        // $flag = $data_valid->count_one ( $data );
        // if (! $flag) {
        //     return $this->out(false,'超过当期下注最大金额，请联系管理人员!');
        // }
    }

    public function dataCheck($data)
    {
        $eventOfficial = EventOfficial::find()
            ->where(['status' => 1])
            ->andWhere(['qishu' => $data['qishu']])
            ->asArray()
            ->one();

        if ($data['game_type'] == 1) {
            $eventTwopk = EventTwopk::find()
                ->where(['qishu' => $data['game_id']])
                ->asArray()
                ->one();

            if (!$eventTwopk || $eventTwopk['official_id'] != $eventOfficial['id']) {
                return false;
            }

            if ($data['game_item_id'] != $eventTwopk['player1'] && $data['game_item_id'] != $eventTwopk['player2']) {
                return false;
            }
        } elseif ($data['game_type'] == 2) {
            $eventMultiple = EventMultiple::find()
                ->from("event_multiple as o1")
                ->innerJoin("event_multiple_odds as o2", "o1.id = o2.multiple_id")
                ->where(['o1.qishu' => $data['game_id']])
                ->andWhere(['o2.id' => $data['game_item_id']])
                ->asArray()
                ->one();

            if (!$eventMultiple || $eventMultiple['official_id'] != $eventOfficial['id']) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    // 验证用户组所在的最大最小金额
    function bet_scope_limit($data, $lotterytype)
    {
        $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $ugul = UserGroup::getUserGroupInfo($userid);
        $lowestMoney = $ugul[strtolower ($lotterytype) . '_lower_bet'];
        $twoMaxMoney = $ugul[strtolower ($lotterytype) . '_max_bet_two'];
        $multiMaxMoney = $ugul[strtolower ($lotterytype) . '_max_bet_multi'];

        if ($data['bet_money'] < $lowestMoney) {
            return false;
        }

        if ($data['game_type'] == 1 && $data['bet_money'] > $twoMaxMoney) {
            return false;
        }

        if ($data['game_type'] == 2 && $data['bet_money'] > $multiMaxMoney) {
            return false;
        }

        return true;
    }

    public function user_money_limit($data)
    {
        $userId = Yii::$app->session->get('uid');
        $userInfo = UserList::getUserInfo($userId);
        $balance = $userInfo['money'] - $data;

        if ($balance < 0) {
            return false;
        }

        return true;
    }

    public function bet_time_limit()
    {
        $eventOfficial = EventOfficial::find()
            ->where(['status' => 1])
            ->andWhere(['<=', 'kaipan_time', date("Y-m-d H:i:s")])
            ->andWhere(['>=', 'fenpan_time', date("Y-m-d H:i:s")])
            ->orderBy(['kaipan_time' => SORT_DESC])
            ->asArray()
            ->one();

        if (!$eventOfficial) {
            return false;
        }

        $now = strtotime(date("Y-m-d H:i:s"));
        $kaipanTime = strtotime($eventOfficial['kaipan_time']);
        $fenpanTime = strtotime($eventOfficial['fenpan_time']);

        if ($now < $kaipanTime || $now > $fenpanTime) {
            return false;
        }

    	return true;
    }

    public function risk($data, $game)
    {
        if ($data['game_type'] == 1) {
        // 兩方
            $this->riskTwopk($data, $game);
        } else {
        // 多項目
            $this->riskMultiple($data, $game);
        }
    }

    public function riskTwopk($data, $game)
    {
        // 判斷目前下注對象
        if ($data['game_item_id'] == $game['player1']) {
            $main = 'player1';
            $other = 'player2';
        } else {
            $main = 'player2';
            $other = 'player1';
        }

        // 抓該下注對象log裡最新一筆資料，無資料的話表示目前無人下注
        $eventTwopkOddsLog = EventTwopkOddsLog::find()
            ->where(['official_id' => $game['official_id']])
            ->andWhere(['twopk_id' => $game['id']])
            ->andWhere(['game_item_id' => $data['game_item_id']])
            ->orderBy(['create_time' => SORT_DESC])
            ->asArray()
            ->one();

        $amount = $eventTwopkOddsLog['player_amount'] > 0 ? $eventTwopkOddsLog['player_amount'] : 0;
        $amount += $data['bet_money'];
        $lose = $eventTwopkOddsLog['player_lose'] > 0 ? $eventTwopkOddsLog['player_lose'] : 0;
        $lose += $data['bet_money'] * $game['odds'];
        $mainOdds = $game[$main . '_odds'];
        $otherOdds = $game[$other . '_odds'];

        // 再抓一筆最新的算總下注金額
        $last = EventTwopkOddsLog::find()
            ->where(['official_id' => $game['official_id']])
            ->andWhere(['twopk_id' => $game['id']])
            ->orderBy(['create_time' => SORT_DESC])
            ->asArray()
            ->one();

        $total_amount = $last['total_amount'] > 0 ? $last['total_amount'] : 0;
        $total_amount += $data['bet_money'];

        // 盈利率
        $rate = ($total_amount - $lose) / $total_amount;

        if ($total_amount >= $game['start_amount']) {
            $main_odds = $main . '_odds';
            $other_odds = $other . '_odds';
            $main_status = $main . '_status';
            $other_status = $other . '_status';

            if ($rate >= 0.03) {
                if ($game[$other . '_status'] != 1) {
                    $eventTwopkOddsLog = EventTwopkOddsLog::find()
                        ->where(['official_id' => $game['official_id']])
                        ->andWhere(['twopk_id' => $game['id']])
                        ->andWhere(['game_item_id' => $game[$other]])
                        ->orderBy(['create_time' => SORT_DESC])
                        ->asArray()
                        ->one();

                    $otherRate = ($total_amount - $eventTwopkOddsLog['player_lose']) / $total_amount;

                    if ($otherRate > -0.01) {
                        $eventTwopk = EventTwopk::findOne($game['id']);
                        $eventTwopk->$main_status = 1;
                        $eventTwopk->$other_status = 1;
                        $eventTwopk->save();

                        $mainOdds = 1.9;
                        $otherOdds = 1.9;
                    }
                }
            } elseif ($rate < 0.03 && $rate > -0.01) {
                if ($game[$other . '_status'] != 1) {
                    $eventTwopkOddsLog = EventTwopkOddsLog::find()
                        ->where(['official_id' => $game['official_id']])
                        ->andWhere(['twopk_id' => $game['id']])
                        ->andWhere(['game_item_id' => $game[$other]])
                        ->orderBy(['create_time' => SORT_DESC])
                        ->asArray()
                        ->one();

                    $otherRate = ($total_amount - $eventTwopkOddsLog['player_lose']) / $total_amount;

                    if ($otherRate > -0.01) {
                        $eventTwopk = EventTwopk::findOne($game['id']);
                        $eventTwopk->$main_status = 1;
                        $eventTwopk->$other_status = 1;
                        $eventTwopk->save();
                    }

                    $mainOdds = 1.9;
                    $otherOdds = 1.9;
                } else {
                    $mainOdds = $game[$main . '_odds'] - $game['adj_basic'];
                    $otherOdds = $game[$other . '_odds'] + $game['adj_basic'];
                }
            } elseif ($rate <= -0.01) {
                $mainOdds = 1.7;
                $otherOdds = 2.1;

                $eventTwopk = EventTwopk::findOne($game['id']);
                $eventTwopk->$main_status = 2;
                $eventTwopk->$other_status = 1;
                $eventTwopk->save();
            }

            $eventTwopkOdds = EventTwopkOdds::findOne($game['odds_id']);
            $eventTwopkOdds->$main_odds = $mainOdds;
            $eventTwopkOdds->$other_odds = $otherOdds;
            $eventTwopkOdds->save();
        }

        $main_odds_new = $main . '_odds_new';
        $other_odds_new = $other . '_odds_new';
        $eventTwopkOddsLog = new EventTwopkOddsLog();
        $eventTwopkOddsLog->official_id = $game['official_id'];
        $eventTwopkOddsLog->twopk_id = $game['id'];
        $eventTwopkOddsLog->user_id = Yii::$app->session->get('uid');
        $eventTwopkOddsLog->bet_time = date("Y-m-d H:i:s");
        $eventTwopkOddsLog->bet_money = $data['bet_money'];
        $eventTwopkOddsLog->game_item_id = $data['game_item_id'];
        $eventTwopkOddsLog->player1_odds_old = $game['player1_odds'];
        $eventTwopkOddsLog->player2_odds_old = $game['player2_odds'];
        $eventTwopkOddsLog->$main_odds_new = $mainOdds;
        $eventTwopkOddsLog->$other_odds_new = $otherOdds;
        $eventTwopkOddsLog->player_rate_new = $rate;
        $eventTwopkOddsLog->player_lose = $lose;
        $eventTwopkOddsLog->player_amount = $amount;
        $eventTwopkOddsLog->total_amount = $total_amount;
        $eventTwopkOddsLog->adj_basic = $game['adj_basic'];
        $eventTwopkOddsLog->lose = $data['bet_money'] * $game['odds'];;
        $eventTwopkOddsLog->create_time = date("Y-m-d H:i:s");
        $eventTwopkOddsLog->save();
    }

    public function riskMultiple($data, $game)
    {
        // 抓一筆最新的算總下注金額
        $last = EventMultipleOddsLog::find()
            ->where(['official_id' => $game['official_id']])
            ->andWhere(['multiple_id' => $game['id']])
            ->orderBy(['create_time' => SORT_DESC])
            ->asArray()
            ->one();

        $total_amount = $last['total_amount'] > 0 ? $last['total_amount'] : 0;
        $total_amount += $data['bet_money'];

        if ($total_amount >= 30000) {
            // 判斷該多項目的其他item是否有被關，檢查是否能夠開啟
            $eventMultipleOdds = EventMultipleOdds::find()
                ->where(['official_id' => $game['official_id']])
                ->andWhere(['multiple_id' => $game['id']])
                ->andWhere(['status' => 2])
                ->orderBy(['create_time' => SORT_DESC])
                ->asArray()
                ->all();

            foreach ($eventMultipleOdds as $key => $val) {
                $closed = EventMultipleOddsLog::find()
                    ->where(['official_id' => $val['official_id']])
                    ->andWhere(['multiple_id' => $val['multiple_id']])
                    ->andWhere(['game_item_id' => $val['id']])
                    ->orderBy(['create_time' => SORT_DESC])
                    ->asArray()
                    ->one();

                // 盈利率
                $rate = ($total_amount - $closed['item_lose']) / $total_amount;

                if ($rate >= 0.03) {
                    $eventMultipleOdds = EventMultipleOdds::findOne($val['id']);
                    $eventMultipleOdds->status = 1;
                    $eventMultipleOdds->save();
                }
            }
        }

        // 抓該下注對象log裡最新一筆資料，無資料的話表示目前無人下注
        $eventMultipleOddsLog = EventMultipleOddsLog::find()
            ->where(['official_id' => $game['official_id']])
            ->andWhere(['multiple_id' => $game['id']])
            ->andWhere(['game_item_id' => $game['odds_id']])
            ->orderBy(['create_time' => SORT_DESC])
            ->asArray()
            ->one();

        $amount = $eventMultipleOddsLog['amount'] > 0 ? $eventMultipleOddsLog['amount'] : 0;
        $amount += $data['bet_money'];

        // 盈利率
        $rate = ($total_amount - $amount * $game['odds']) / $total_amount;

        if ($total_amount >= 30000 && $rate < 0.03) {
            $eventMultipleOdds = EventMultipleOdds::findOne($game['odds_id']);
            $eventMultipleOdds->status = 2;
            $eventMultipleOdds->save();
        }

        $eventMultipleOddsLog = new EventMultipleOddsLog();
        $eventMultipleOddsLog->official_id = $game['official_id'];
        $eventMultipleOddsLog->multiple_id = $game['id'];
        $eventMultipleOddsLog->user_id = Yii::$app->session->get('uid');
        $eventMultipleOddsLog->bet_time = date("Y-m-d H:i:s");
        $eventMultipleOddsLog->bet_money = $data['bet_money'];
        $eventMultipleOddsLog->game_item_id = $game['odds_id'];
        $eventMultipleOddsLog->odds = $game['odds'];
        $eventMultipleOddsLog->rate_new = $rate;
        $eventMultipleOddsLog->item_lose = $amount * $game['odds'];
        $eventMultipleOddsLog->amount = $amount;
        $eventMultipleOddsLog->total_amount = $total_amount;
        $eventMultipleOddsLog->lose = $data['bet_money'] * $game['odds'];
        $eventMultipleOddsLog->create_time = date("Y-m-d H:i:s");
        $eventMultipleOddsLog->save();
    }
}
