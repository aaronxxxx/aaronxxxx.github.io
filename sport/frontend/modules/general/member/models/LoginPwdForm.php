<?php

namespace app\modules\general\member\models;

use yii\base\Model;

/**
 * LoginPwdForm is the model behind the login pwd form.
 */
class LoginPwdForm extends Model {
    public $pwd_old;
    public $pwd;
    public $pwd_confirm;
    
    public function rules() {
        return [
            [['pwd_old','pwd','pwd_confirm'], 'trim'],
            [['pwd_old','pwd','pwd_confirm'], 'required'],
            ['pwd', 'compare', 'compareAttribute' => 'pwd_confirm', 'message' => '密码和确认密码不一致'],
        ];
    }
}

