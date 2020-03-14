<?php
namespace app\modules\game\services;

use Yii;
use yii\base\Object;
use app\common\helpers\LogUtils;
use app\modules\live\models\LiveUser;

class AiService extends Object
{
    /**
     * 設置curl
     * @param $url
     * @param $type      POST || GET
     * @param $field     傳送參數
     */
    public static function setCurl($url, $type, $field)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // 設定不要直接顯示在畫面
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'               // 設定使用json格式傳參
        ]);

        if ($type == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
        }

        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $output;
    }

    /**
     * 取得密鑰
     */
    public static function agentLogin()
    {
        $url = 'http://x1.xianpk10.com/api/Neil/AgentLogin';

        $field = json_encode([
            'userid' => 'fly',
            'password' => 'test123'
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $result = $output['data'];

            return $result;
        } else {
            // 登入失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 用戶名查詢ID
     */
    public static function queryMemberId($token, $name)
    {
        $url = 'http://x1.xianpk10.com/api/Neil/QueryMemberId';

        $field = json_encode([
            'token' => $token,
            'userid' => $name
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0 && $output['data']['id'] > 0) {
            $result = $output['data']['id'];

            return $result;
        } else {
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 創建新玩家
     */
    public static function register($agent, $user)
    {
        $url = "http://x1.xianpk10.com/api/Neil/Register";

        $field = json_encode([
            'token' => $agent['token'],
            'userid' => $user['name'],
            'password' => $user['pwd'],
            'agentid' => $agent['id']
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $liveUser = LiveUser::findOne([
                'live_type' => 'AI',
                'live_username' => $user['name'],
                'live_password' => $user['pwd']
            ]);

            $liveUser->ai_userid = $output['data']['id'];
            $liveUser->save();

            $result = $output['data']['id'];

            return $result;
        } else {
            // 創建失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 用戶登入 進入遊戲
     */
    public static function userLogin($token, $player)
    {
        $url = 'http://x1.xianpk10.com/api/Neil/UserLogin';

        $field = json_encode([
            'token' => $token,
            'id' => $player
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $result = $output['data']['url'];

            return $result;
        } else {
            // 登入失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 用戶查詢餘額
     */
    public static function queryBalance($token, $player)
    {
        $url = 'http://x1.xianpk10.com/api/Neil/QueryBalance';

        $field = json_encode([
            'token' => $token,
            'id' => $player
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $result = $output['data']['balance'];

            return $result;
        } else {
            // 查詢失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 平台對第三方 存款
     */
    public static function deposit($token, $player, $amount, $orderId)
    {
        $url = 'http://x1.xianpk10.com/api/Neil/Transfer';

        $field = json_encode([
            'token' => $token,
            'id' => $player,
            'amount' => $amount,
            'type' => 0,
            'orderid' => $orderId
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $result = $output['data'];

            return $result;
        } else {
            // 存款失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 平台對第三方 取款
     */
    public static function withdraw($token, $player, $amount, $orderid)
    {
        $url = 'http://x1.xianpk10.com/api/Neil/Transfer';

        $field = json_encode([
            'token' => $token,
            'id' => $player,
            'amount' => $amount,
            'type' => 1,
            'orderid' => $orderid
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            $result = $output['data'];

            return $result;
        } else {
            // 存款失敗
            // LogUtils::error_log($output);
            return null;
        }
    }

    /**
     * 遊戲紀錄
     */
    public static function gameRoundsRecord($token)
    {
        $platformType = 'AI';
        $use_table = 'live_order';
        $processInfo = [];
        $count = 0;

		//查詢目前目錄採集進度
        $filename = Yii::$app->getBasePath() . "/collectionData/collectionAi.json";

		if (file_exists($filename)) {
			$jsonData = file_get_contents($filename);
			$data = json_decode($jsonData, true);
			$lastOrderNum = $data['orderNum'];
		} else {
            $lastOrderNum = 0;
		}

        $processInfo['startTime'] = date('Y-m-d H:i:s');
        $start = date('Y-m-d H:i:s', strtotime('-1 Hour'));
        $url = "http://x1.xianpk10.com/api/Neil/QueryTicketsFromAgentIdByForex";

        $field = json_encode([
            'token' => $token,
            'startTime' => $start,
            'endTime' => date('Y-m-d H:i:s')
        ]);

        $output = self::setCurl($url, 'POST', $field);

        if (isset($output['code']) && $output['code'] == 0) {
            if (count($output['data']['tickets']) > 0) {
                $duplicatie_update_field = [];
                $fieldArray = [
                    'live_username',
                    'order_num',
                    'order_time',
                    'live_th',
                    'live_type',
                    'live_office',
                    'live_result',
                    'bet_info',
                    'bet_money',
                    'live_win',
                    'ip',
                    'game_type',
                    'valid_bet_amount',
                    'balanceAfter'
                ];

                foreach ($output['data']['tickets'] as $key => $val) {
                    // 只新增orderid大於目前紀錄的單
                    if ($val['orderid'] > $lastOrderNum) {
						switch ($val['symbol']) {
							case 'USDCHF':
								$live_th = '美元/瑞士法郎';
								break;
							case 'GBPUSD':
								$live_th = '英鎊/美元';
								break;
							case 'EURUSD':
								$live_th = '歐元/美元';
								break;
							case 'USDJPY':
								$live_th = '美元/日元';
								break;
							case 'NZDUSD':
								$live_th = '紐幣/美元';
								break;
							case 'AUDUSD':
								$live_th = '澳幣/美元';
								break;
							case 'USDCAD':
								$live_th = '美元/加幣';
								break;
							case 'XAUUSD':
								$live_th = '黃金/美元';
								break;
							case 'XAGUSD':
								$live_th = '白銀/美元';
								break;
							case 'BTCEUR':
								$live_th = '比特/歐元';
								break;
							case 'BTCUSD':
								$live_th = '比特/美元';
								break;
							case 'ETHUSD':
								$live_th = '乙太/美元';
								break;
							case 'LTCUSD':
								$live_th = '萊特/美元';
								break;
							default:
								$live_th = $val['symbol'];
								break;
						}

						switch ($val['betType']) {
							case '4':
								$live_type = '大小';
								$bet_info = ($val['betValue'] == 1) ? '小' : '大';
								break;
							case '5':
								$live_type = '單雙';
								$bet_info = ($val['betValue'] == 1) ? '單' : '雙';
								break;
							case '6':
								$live_type = '龍虎';
								break;
							case '7':
								$live_type = '名次';
								break;
							default:
								$live_type = $val['betType'];
								break;
						}

						$count ++;
                        $valueArray[$val['orderid']] = [
                            'live_username' => $val['name'],
                            'order_num' => $val['orderid'],
                            // AI那邊的時間格式 2019-11-06T05:43:33.000Z
                            'order_time' => date("Y-m-d H:i:s", strtotime($val['createTime'])),
                            'live_th' => $live_th,                  // 遊戲名
                            'live_type' => $live_type,              // 下注類型，4:大小 5:單雙 6:龍虎 7:名次
                            'live_office' => $val['period'],        // AI的期數
                            'live_result' => null,
                            'bet_info' => $bet_info,
                            'bet_money' => $val['totalGold'],
                            'live_win' => $val['totalBonus'] - $val['totalGold'],    // 贏的錢 - 下注的錢
                            'ip' => null,
                            'game_type' => $platformType,
                            'valid_bet_amount' => $val['totalGold'],
                            'balanceAfter' => null
                        ];

                        $processInfo['orderNum'] = $val['orderid'];
                        $processInfo['lastDate'] = date("Y-m-d H:i:s", strtotime($val['createTime']));
                    }
                }

				ksort($valueArray);

                foreach ($fieldArray as $key => $val) {
                    if ($val != 'createtime') {
                        $duplicatie_update_field[] = $val . " = VALUES(" . $val . ")";
                    }
                }

                $db = Yii::$app->db;
                $sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
                $db->createCommand($sql . ' ON DUPLICATE KEY UPDATE ' . implode(', ', $duplicatie_update_field))
                ->execute();
            }
        }

        // 把當次採集進度記錄起來
        file_put_contents($filename, json_encode($processInfo));

        return $count;
    }
}
