<?php

namespace app\modules\core\passport\models;

use yii\base\Model;

/**
 * AgentsRegisterForm is the model behind the register form.
 */
class AgentsRegisterForm extends Model {
    public $username;
    public $password;
    public $repassword;
    public $real_name;
    public $tel;
    public $email;
    public $verifyCode;
    
    public function rules() {
        return [
            [['username','password','repassword','real_name','tel','email'], 'trim'],
            [['username','password','repassword','real_name','tel','email'], 'required','message' => '字段不能为空'],
            ['username','string','length' => [4,12],'tooLong' => '用户名为4-12个字符','tooShort' => '用户名为4-12个字符'],
            ['password','string','length' => [6,12],'tooLong' => '密码为6-12个字符','tooShort' => '密码为6-12个字符'],
            ['password','match','pattern'=>'/^[A-Za-z0-9]+$/','message' => '密码只能输入由数字和26个英文字母组成的字符串'],
            ['tel','string','length' => [8,11],'tooLong' => '手机号码位数输入错误','tooShort' => '手机号码位数输入错误'],
            ['email','email','message' => '邮箱格式输出错误'],
//            ['real_name','match','pattern'=>'/^[/u4e00-/u9fa5]{0,}$/','message' => '真实姓名只能为汉字'],        
        ];
    }
}

