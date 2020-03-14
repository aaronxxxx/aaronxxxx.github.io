<?php

namespace app\modules\live\models;

use yii\db\ActiveRecord;

/**
 * UserList is the model behind the user_list.
 */
class UserList extends ActiveRecord
{

    public function getLiveUser()
    {
        return $this->hasMany(LiveUser::className(), ['user_id' => 'user_id']);
    }

    public static function getUserById($uid)
    {
        $rs = UserList::find()->where(['user_id' => $uid])->asArray()->one();
        return $rs;
    }

    public static function getUserByNname($name)
    {
        $rs = UserList::find()->where(['user_name' => $name])->asArray()->one();
        return $rs;
    }

    public static function getUserIdByUserName($userGroup = null, $userIgnoreGroup = null)
    {
        $query = UserList::find()->select(['user_id']);
        if ($userGroup != null) {
            $query->andWhere(['in', 'user_name', $userGroup]);
        }
        if ($userGroup == null && $userIgnoreGroup != null) {
            $query->andWhere(['not in', 'user_name', $userGroup]);
        }
        return $query->asArray()->all();
    }
}
