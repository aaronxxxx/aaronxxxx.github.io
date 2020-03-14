<?php

namespace app\modules\lottery\models\ar;

/**
 * This is the model class for table "user_group".
 *
 */
class UserGroup extends \yii\db\ActiveRecord
{
	public static function getUserGroupInfo($user_id)
	{
		$sql = "select g.*,u.* from user_group g,user_list u   where u.user_id='" . $user_id . "' and g.group_id=u.group_id limit 0,1";
		$query=self::findBySql($sql);
		$rsarr=$query->asArray()->one();
		return $rsarr;
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }
}
