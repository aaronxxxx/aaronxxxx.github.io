<?php
namespace app\modules\game\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;
use app\modules\live\models\LiveUser;
use Yii;

class IgService extends Object
{
    /**
     * 設置curl
     * @param $url
     * @param $type      POST || GET
     * @param $header    token
     * @param $field     傳送參數
     */
    public function setCurl($url, $type, $header = null, $field = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // 設定不要直接顯示在畫面

        if ($type == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
        }

        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if ($field) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($field));
        }

        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $output;
    }

    /**
     * 取得密鑰
     */
    public function getToken()
    {
        $url = "https://admin-stage.iconic-gaming.com/service/login";

        $field = [
            'username' => 'yunhangCompany2019',
            'password' => '6VQeGKdsKyrd'
        ];

        $output = self::setCurl($url, 'POST', null, $field);

        if (isset($output['data'])) {
            $result = ["Authorization: Bearer " . $output['token']];

            return $result;
        } else {
            // 登入失敗
            LogUtils::error_log($output['error']['message']);
        }
    }

    /**
     * 搜尋玩家by id
     * 這個id是IG那邊的id，不是我們這邊的
     */
    public function getPlayerById($token, $id)
    {
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/players/" . $id;

        $output = self::setCurl($url, 'GET', $token);

        if ($output) {
            $result = $output['data'];
        } else {
            $result = null;    // 無會員資料
        }

        return $result;
    }

    /**
     * 搜尋玩家by user name
     */
    public function getPlayerByName($token, $name)
    {
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/players?player=" . $name;

        $output = self::setCurl($url, 'GET', $token);

        if ($output) {
            $result = $output['data'][0];
        } else {
            $result = null;    // 無會員資料
        }

        return $result;
    }

    /**
     * 建立新玩家
     */
    public function createNewPlayer($token, $name)
    {
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/players";

        $field = [
            'username' => $name,
            'nickname' => $name
        ];

        $output = self::setCurl($url, 'POST', $token, $field);

        if (isset($output['data'])) {
            $result = $output['data'];

            return $result;
        } else {
            // 創建失敗
            LogUtils::error_log($output['error']['message']);
        }
    }

    /**
     * 存款
     */
    public function deposit($token, $transactionId, $amount, $player)
    {
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/players/deposit";

        $field = [
            'transactionId' => $transactionId,    // 單號，不可重複
            'amount' => $amount,    // 如要交易 100 貨幣，請輸入 10000
            'player' => $player    // user name
        ];

        $output = self::setCurl($url, 'POST', $token, $field);

        if (isset($output['data'])) {
            $result = $output['data'];
        } else {
            // 存款失敗
            $result = $output['error'];
            LogUtils::error_log($output['error']['message']);
        }

        return $result;
    }

    /**
     * 取款
     */
    public function withdraw($token, $transactionId, $amount, $player)
    {
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/players/withdraw";

        $field = [
            'transactionId' => $transactionId,    // 單號，不可重複
            'amount' => $amount,    // 如要交易 100 貨幣，請輸入 10000
            'player' => $player    // user name
        ];

        $output = self::setCurl($url, 'POST', $token, $field);

        if (isset($output['data'])) {
            $result = $output['data'];
        } else {
            // 取款失敗
            $result = $output['error'];
            LogUtils::error_log($output['error']['message']);
        }

        return $result;
    }

    /**
     * 開啟遊戲
     */
    public function launchGame($setToken, $productId)
    {
        $result = 'https://launcher-stage.iconic-gaming.com/play/' . $productId .
            '?currency=CNY&lang=zh&openExternalBrowser=1&platform=116&token=' . $setToken;

        return $result;
    }

    /**
     * 設置玩家token
     */
    public static function setUserToken($uid)
    {
        $live_user = LiveUser::findOne(['user_id' => $uid, 'live_type' => 'IG']);

        if (empty($live_user)) {
            return false;
        }

        $token = substr(md5('IG' . md5($live_user['live_username']) . time('s')), 0, 15);

        $live_user->ig_token = $token;
        $live_user->save();

        return $token;
    }

    /**
     * 遊戲紀錄
     */
    public function gameRoundsRecord($token)
    {
        $platformType = 'IG';
        $use_table = 'live_order';
        $count = 0;

		//查詢目前目錄採集進度
        // $filename = Yii::$app->getBasePath() . "/" . self::$rootPath . "/collectionIg.json";
        $filename = Yii::$app->getBasePath() . "/collectionData/collectionIg.json";

		if (file_exists($filename)) {
			$jsonData = file_get_contents($filename);
			$data = json_decode($jsonData, true);
			$processInfo = $data;
		} else {
            $processInfo = [];
            $processInfo['orderNum'] = 0;
		}

        $processInfo['startTime'] = date('Y-m-d H:i:s');

        $start = strtotime(gmdate('Y-m-d H:i:s') . "-1 Hour") * 1000;
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/profile/rounds";
        $url .= "?status=finish";         // 該局狀態，finish為完成狀態
        $url .= "&order=asc";             // 正排序，時間越早排前面
        $url .= "&start=" . $start;       // 建立起始時間，時區 +0, 需補到毫秒 Ex. 1566230400000
        // $url .= "&end=" . $end;        // 建立結束時間，時區 +0, 需補到毫秒 Ex. 1566230400000
        $url .= "&pageSize=10000";        // 單頁顯示筆數，預設 10 筆，單次最大查詢 10,000 筆

        $output = self::setCurl($url, 'GET', $token);

        if ($output['totalSize'] > 0) {
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

            foreach ($output['data'] as $key => $val) {
				// 只新增id大於目前紀錄的單
                if ($val['id'] > $processInfo['orderNum']) {
                    $count ++;
                    $valueArray[$val['id']] = [
                        'live_username' => $val['player'],
						'order_num' => $val['id'],
						// IG那邊的時間格式 2019-11-06T05:43:33.000Z
                        'order_time' => date("Y-m-d H:i:s", strtotime($val['createdAt'])),
                        'live_th' => $val['productId'],       // 遊戲代號
                        'live_type' => $val['gameType'],      // 遊戲類別
                        'live_office' => $val['game'],        // 遊戲名稱
                        'live_result' => null,
                        'bet_info' => null,
                        'bet_money' => $val['bet'] / 100,     // IG那邊的金錢單位必須除100才會等於正常單位
                        'live_win' => $val['win'] / 100,
                        'ip' => null,
                        'game_type' => $platformType,
                        'valid_bet_amount' => null,
                        'balanceAfter' => null
                    ];

                    $processInfo['orderNum'] = $val['id'];
                    $processInfo['lastDate'] = date("Y-m-d H:i:s", strtotime($val['createdAt']));
                }
			}

			$duplicatie_update_field = [];

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

        // 把當次採集進度記錄起來
        file_put_contents($filename, json_encode($processInfo));

        return $count;
    }
}
