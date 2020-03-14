<?php

namespace app\modules\live\models;

use app\modules\core\common\models\UserList;
use yii\db\ActiveRecord;

/**
 * LiveUser is the model behind the live_user.
 */
class LiveUser extends ActiveRecord {

    public function getUser() {
        return $this->hasOne(UserList::className(), ['user_id' => 'user_id']);
    }
}
