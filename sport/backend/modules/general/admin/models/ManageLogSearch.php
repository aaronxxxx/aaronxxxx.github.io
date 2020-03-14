<?php

namespace app\modules\general\admin\models;

use app\common\data\ActiveDataProvider;
use yii\base\Model;

/**
 * ManageLogSearch represents the model behind the search form about `common\models\ManageLog`.
 */
class ManageLogSearch extends ManageLog
{

    public function rules()
    {
        return [
            [['manage_name'], 'string', 'max' => 16],
            [['edlog'], 'string', 'max' => 200]
        ];
    }

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
        $query = ManageLog::find()->where(['!=', 'manage_name', 'sysadmin']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params, '');
        //$this->manage_name = isset($params['manage_name'])?$params['manage_name']:null;
        //$this->edlog = isset($params['edlog'])?$params['edlog']:null;
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'manage_name', $this->manage_name])
            ->andFilterWhere(['like', 'edlog', $this->edlog])->orderBy([
               'edtime' => SORT_DESC
            ]);
        return $dataProvider;

    }
}
