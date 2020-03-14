<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "user_list".
 *
 */
class UserList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_list';
    }
    
    public static function getUserInfo($userid)
    {
        //彩票下注 取user_list时 新增for update
    	$sql = "select * from user_list where user_id = '$userid' for update";
        $r = UserList::findBySql($sql)->asArray()->one();
        return $r;
    }
    static public function getUserNewsByUserID($uid){
        $sql = "select * from user_list where user_id = '$uid' ";
        $r = UserList::findBySql($sql)->asArray()->one();
        return $r;
    }
    //只查找id和money 彩票投注调用
    public static function OrderMoneyAndId($userid)
    {
        $query=self::find()->select(['id','money'])->where(['user_id'=>$userid]);
        $rsarr=$query->asArray()->one();
        return $rsarr;
    }
}
