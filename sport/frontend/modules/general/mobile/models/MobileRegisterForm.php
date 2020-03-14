<?php

namespace app\modules\general\mobile\models;

use yii\base\Model;

/**
 * MobileRegisterForm is the model behind the register form.
 */
class MobileRegisterForm extends Model {
    public $name;
    public $pwd;
    public $withdraw_pwd;
    public $real_name;
    public $phone;
    public $email;
    public $qq;
    public $agent_name;
    public $verifyCode;
    public $trade_type;

    public function rules() {
        return [
            [['name','pwd','withdraw_pwd','real_name','phone','email','agent_name','qq','trade_type'], 'trim'],
            // [['name','pwd','withdraw_pwd','real_name'], 'required','message' => '字段不能为空'],
            [['name','pwd','withdraw_pwd'], 'required','message' => '字段不能为空'],
            ['name','string','length' => [4,12],'tooLong' => '用户名为4-12个字符','tooShort' => '用户名为4-12个字符'],
            ['pwd','string','length' => [6,12],'tooLong' => '密码为6-12个字符','tooShort' => '密码为6-12个字符'],
            ['pwd','match','pattern'=>'/^[A-Za-z0-9]+$/','message' => '密码只能输入由数字和26个英文字母组成的字符串'],
            ['withdraw_pwd','match','pattern'=>'/^[0-9]+$/','message' => '请输入4位的取款密码'],
            ['real_name','match','pattern'=>'/^[A-Za-z_\x{4e00}-\x{9fa5}]+$/u','message' => '真实姓名只能为汉字或英文'],
            ['verifyCode', 'captcha','message' => '验证码错误','captchaAction' => 'mobile/index/captcha'],
//            ['phone','string','length' => [8,11],'tooLong' => '手机号码位数输入错误','tooShort' => '手机号码位数输入错误'],

        ];
    }
}

