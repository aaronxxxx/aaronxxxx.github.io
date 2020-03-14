<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\common\helpers\UAUtils;

/**
 * This is the model class for table "manage_log".
 *
 * @property integer $id
 * @property string $manage_name
 * @property string $login_ip
 * @property string $login_time
 * @property string $edlog
 * @property string $session_str
 * @property string $logout_time
 * @property string $edtime
 * @property string $run_str
 */
class AgentsManageLog extends ActiveRecord{

    public static function tableName()
    {
        return 'manage_log';
    }

    public function rules()
    {
        return [
            [['login_time', 'logout_time', 'edtime'], 'safe'],
            [['edlog'], 'required'],
            [['manage_name'], 'string', 'max' => 16],
            [['login_ip'], 'string', 'max' => 20],
            [['edlog'], 'string', 'max' => 200],
            [['session_str', 'run_str'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manage_name' => '管理員',
            'login_ip' => '登錄IP',
            'login_time' => '登錄時間',
            'edlog' => '操作內容',
            'session_str' => '登錄時候產生的guid',
            'logout_time' => '退出時間',
            'edtime' => '操作時間',
            'run_str' => '瀏覽器標識',
        ];
    }

    /**
     * 對用戶操作做記錄
     */
    static public function saveLog($userName,$reason,$session_str=''){
        $runStr = '';
        $ip = Yii::$app->request->getUserIP();

        $result = false;
        if($userName){
            //瀏覽器標識
            $runStr = UAUtils::getClientBrowser();
            $log = new AgentsManageLog();
            $log->manage_name = $userName;
            $log->login_ip = $ip;
            $log->login_time = date('Y-m-d H:i:s');
            $log->edlog = $reason;
            $log->edtime = date('Y-m-d H:i:s');
            $log->run_str = $runStr;
            $log->session_str = $session_str;
            $result = $log->save();
        }
        return $result;
    }
}