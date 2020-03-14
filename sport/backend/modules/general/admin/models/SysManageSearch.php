<?php

namespace app\modules\general\admin\models;

use app\common\data\ActiveDataProvider;
use app\modules\core\common\models\SysManage;
use yii\base\Model;

/**
 * SysManageSearch represents the model behind the search form about `common\models\SysManage`.
 */
class SysManageSearch extends SysManage
{

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SysManage::find()->where(['!=', 'manage_name', 'sysadmin']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
