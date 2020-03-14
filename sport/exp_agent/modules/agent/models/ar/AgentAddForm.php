<?php
namespace app\modules\agent\models\ar;

use yii\base\Model;

class AgentAddForm extends Model{
    public $agents_name;
    public $agents_pass;
    public $agent_url;
    public $birthday;
    public $tel;
    public $email;
    public $qq;
    public $othercon;
    public $agents_type;
    public $total_1_2;
    public $total_1_scale;
    public $total_2_1;
    public $total_2_2;
    public $total_2_scale;
    public $total_3_1;
    public $total_3_2;
    public $total_3_scale;
    public $total_4_1;
    public $total_4_2;
    public $total_4_scale;
//    public $total_5_1;
//    public $total_5_2;
    //public $total_5_scale;
    public $refunded_scale;
//    public $PK10_return_water;
    public $agent_level;
    public $remark;
    
    public function rules() {
        return [
            [['agents_name','agents_pass','agent_url','birthday','tel','email','qq','othercon','agents_type','total_1_2','total_1_scale','total_2_1','total_2_2','total_2_scale',
                'total_3_1','total_3_2','total_3_scale','total_4_1','total_4_2','total_4_scale','refunded_scale','remark','agent_level'], 'trim'],
            ['tel','string','length' => [8,11],'tooLong' => '手機號碼位數輸入錯誤','tooShort' => '手機號碼位數輸入錯誤'],
            ['email','email','message' => '郵箱格式輸出錯誤'], 
            ['qq','match','pattern'=>'/^[0-9]+$/','message' => 'QQ號碼都是數字'],
        ];
    }
    
    
}

