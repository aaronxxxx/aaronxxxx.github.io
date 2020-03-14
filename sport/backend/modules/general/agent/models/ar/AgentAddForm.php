<?php
namespace app\modules\general\agent\models\ar;

use yii\base\Model;

class AgentAddForm extends Model{
    public $agent_level;
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
//    public $total_5_scale;
    public $refunded_scale;
    public $limit_money;
    public $remark;
    
    public function rules() {
        return [
            [['agents_name','agents_pass','agent_url','tel','email','qq','othercon','agents_type','total_1_2','total_1_scale','total_2_1','total_2_2','total_2_scale',
                'total_3_1','total_3_2','total_3_scale','total_4_1','total_4_2','total_4_scale','refunded_scale','agent_level','limit_money'], 'required','message' => '字段不能为空'],
            ['tel','string','length' => [8,11],'tooLong' => '手机号码位数输入错误','tooShort' => '手机号码位数输入错误'],
            ['email','email','message' => '邮箱格式输出错误'],
            ['qq','match','pattern'=>'/^[0-9]+$/','message' => 'QQ号码都是数字'],
        ];
    }
    
    
}

