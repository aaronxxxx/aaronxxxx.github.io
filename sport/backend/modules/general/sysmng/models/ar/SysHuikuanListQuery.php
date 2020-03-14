<?php

namespace app\modules\general\sysmng\models\ar;

/**
 * This is the ActiveQuery class for [[SysHuikuanList]].
 *
 * @see SysHuikuanList
 */
class SysHuikuanListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SysHuikuanList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SysHuikuanList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
