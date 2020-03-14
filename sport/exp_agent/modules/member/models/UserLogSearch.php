<?php

namespace app\modules\member\models;

use app\common\data\ActiveDataProvider;
use app\modules\member\models\ar\UserLog;
use yii\base\Model;

/**
 * ManageLogSearch represents the model behind the search form about `common\models\ManageLog`.
 */
class UserLogSearch extends UserLog
{

    public function rules()
    {
        return [
            [['user_name'], 'string', 'max' => 16],
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
        $query = UserLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params, '');
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'edlog', $this->edlog])->orderBy([
               'edtime' => SORT_DESC
            ]);
        return $dataProvider;
    }
}
