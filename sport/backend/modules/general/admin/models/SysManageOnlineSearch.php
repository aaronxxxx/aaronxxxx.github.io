<?php

namespace app\modules\general\admin\models;

use app\common\data\ActiveDataProvider;
use app\modules\core\common\models\SysManageOnline;
use yii\base\Model;

/**
 * SysManageSearch represents the model behind the search form about `common\models\SysManage`.
 */
class SysManageOnlineSearch extends SysManageOnline
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
        $query = SysManageOnline::find()->where(['!=', 'manage_name', 'sysadmin'])->orderBy('onlinetime desc');

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
