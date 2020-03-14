<?php

namespace app\modules\core\passport\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model {
    public $name;
    public $pwd;
    public $verifyCode;
    
    public function rules() {
        return [
            [['name','pwd','verifyCode'], 'trim'],
            [['name','pwd','verifyCode'], 'required'],
            ['verifyCode', 'captcha','message' => '验证码错误','captchaAction' => 'passport/site/captcha'],
        ];
    }
}

