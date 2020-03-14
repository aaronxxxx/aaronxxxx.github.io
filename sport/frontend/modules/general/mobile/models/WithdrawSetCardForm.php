<?php
namespace app\modules\general\mobile\models;

use yii\base\Model;

/**
 * 取款验证
 * WithdrawPwdForm is the model behind the withdraw pwd form.
 */
class WithdrawSetCardForm extends Model {
    public $qk_pwd;         //取款密码
    public $pay_card;       //银行
    public $pay_num;        //卡号
    public $add1;           //开户地区
    public $add2;           //开户市
    public $add3;           //开户网点

    public function rules() {
        return [
            [['qk_pwd','pay_card','pay_num','add1','add2','add3'], 'trim'],
            [['qk_pwd','pay_card','pay_num','add1','add2','add3'], 'required','message' => '字段不能为空'],
            // ['pay_num','match','pattern'=>'/(^\d{16,19}$)/','message' => '卡号输入错误'],
            ['add2','string','length' => [2,20],'tooLong' => '开户市输入错误','tooShort' => '开户市输入错误'],
            ['add3','string','length' => [2,30],'tooLong' => '开户网点输入错误','tooShort' => '开户网点输入错误'],
        ];
    }
}

