<?php
namespace app\modules\member\models\ar;

use yii\base\Model;

class UserAddForm extends Model{
    public $user_name;
    public $user_pass;
    public $qk_pass;
    public $pay_name;
    public $qq;
    public $tel;
    public $group_id;
    public $email;
    public $why;
//    public $account_type;
    
    public function rules() {
        return [
            [['user_name','user_pass','qk_pass','tel','pay_name','qq','group_id','email','why'], 'trim'],
            ['tel','string','length' => [8,11],'tooLong' => '手機號碼位數輸入錯誤','tooShort' => '手機號碼位數輸入錯誤'],
            ['email','email','message' => '郵箱格式輸出錯誤'], 
            ['qq','match','pattern'=>'/^[0-9]+$/','message' => 'QQ號碼都是數字'],
            ['qk_pass','match','pattern'=>'/^[0-9]+$/','message' => '取款號碼請輸入純數字'],
            ['qk_pass','string','length' => [4,4],'tooLong' => '取款號碼請輸入4位數字','tooShort' => '取款號碼請輸入4位數字'],
        ];
    }
    
    
}

