<?php

namespace app\modules\general\mobile\models;

use yii\base\Model;

/**
 * LoginPwdForm is the model behind the login pwd form.
 */
class LoginPwdForm extends Model {
    public $oldLoginpwd;
    public $pwd;
    
    public function rules() {
        return [
            [['oldLoginpwd','pwd'], 'trim'],
            [['oldLoginpwd','pwd'], 'required'],
        ];
    }
}

