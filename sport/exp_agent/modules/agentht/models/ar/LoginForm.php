<?php
namespace app\modules\agentht\models\ar;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model {
    
    public $agents_name;
    public $agents_pass;
    public $yzm;
    
    public function rules() {
        return [
            [['agents_name','agents_pass','yzm'], 'trim'],
            [['agents_name','agents_pass','yzm'], 'required','message' => '字段不能为空'],
            ['yzm', 'captcha','message' => '验证码错误','captchaAction' => 'agentht/index/captcha'],
        ];
    }
}

