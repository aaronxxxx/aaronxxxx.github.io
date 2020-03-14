<?php

namespace app\modules\general\member\models;

use yii\base\Model;

/**
* 汇款表单验证
* RemittanceForm is the model behind the remittance form.
*/
class RemittanceForm extends Model {
    public $v_amount;       //汇款金额
    public $IntoBank;       //汇款银行
    public $InType;         //汇款方式
    public $vlcodes;        //验证码
    
    public function rules() {
        return [
            [['v_amount','IntoBank','InType','vlcodes'], 'trim'],
            [['v_amount','IntoBank','InType','vlcodes'], 'required','message' => '字段不能为空'],
            ['v_amount','number','message' => '金额填写错误'],
            ['vlcodes', 'captcha','message' => '验证码错误','captchaAction' => 'member/index/captcha'],
        ];
    }
}