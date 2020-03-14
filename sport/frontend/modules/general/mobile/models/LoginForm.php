<?php

namespace app\modules\general\mobile\models;

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
            [['name','pwd'], 'trim'],
            [['name','pwd'], 'required'],
            // ['verifyCode', 'captcha','message' => '验证码错误','captchaAction' => 'mobile/index/captcha'],
        ];
    }
}

