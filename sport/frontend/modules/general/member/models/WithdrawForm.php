<?php

namespace app\modules\general\member\models;

use yii\base\Model;

/**
 * 取款验证
 * WithdrawPwdForm is the model behind the withdraw pwd form.
 */
class WithdrawForm extends Model {
    public $qk_pwd;         //取款密码
    public $pay_value;      //取款金额
    public $vlcodes;        //验证码
    
    public function rules() {
        return [
            [['qk_pwd','pay_value','vlcodes'], 'trim'],
            [['qk_pwd','pay_value','vlcodes'], 'required'],
            ['vlcodes', 'captcha','message' => '验证码错误','captchaAction' => 'index/captcha']
        ];
    }
}

