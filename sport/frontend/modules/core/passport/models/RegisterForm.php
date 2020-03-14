<?php

namespace app\modules\core\passport\models;

use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 */
class RegisterForm extends Model {
    public $name;
    public $pwd;
    public $withdraw_pwd;
    public $real_name;
    public $phone;
    public $qq;
    public $email;
    public $agent_name;
    public $trade_type;

    public function rules() {
        return [
            [['name','pwd','withdraw_pwd','real_name','phone','qq','email','agent_name','trade_type'], 'trim'],
            // [['name','pwd','withdraw_pwd','real_name'], 'required','message' => '字段不能为空'],
            [['name','pwd','withdraw_pwd'], 'required','message' => '字段不能为空'],
            ['name','string','length' => [4,12],'tooLong' => '用户名为4-12个字符','tooShort' => '用户名为4-12个字符'],
            ['pwd','string','length' => [6,12],'tooLong' => '密码为6-12个字符','tooShort' => '密码为6-12个字符'],
            ['pwd','match','pattern'=>'/^[A-Za-z0-9]+$/','message' => '密码只能输入由数字和26个英文字母组成的字符串'],
            ['withdraw_pwd','match','pattern'=>'/^[0-9]+$/','message' => '请输入4位的取款密码'],
//            ['phone','string','length' => [8,11],'tooLong' => '手机号码位数输入错误','tooShort' => '手机号码位数输入错误'],
//            ['real_name','match','pattern'=>'/^[/u4e00-/u9fa5]{0,}$/','message' => '真实姓名只能为汉字'],
        ];
    }
}

