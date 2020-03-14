<?php

namespace app\modules\general\message\models;

use app\common\data\ActiveDataProvider;
use app\modules\general\member\models\UserMsg;
use Yii;
use yii\base\Model;

/**
 * SearchLogSearch represents the model behind the search form about `common\models\SearchLog`.
 */
class UserMsgSearch extends UserMsg
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg_title','user_name'], 'safe'],
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
        $query = UserMsg::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['msg_time'] = [
            'asc' => ['msg_time' => SORT_ASC],
            'desc' => ['msg_time' => SORT_DESC],
        ];
        $this->load($params, '');
        //$this->user_name = isset($params['user_name'])?$params['user_name']:null;
        //$this->msg_title = isset($params['msg_title'])?$params['msg_title']:null;
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'msg_title', $this->msg_title])
            ->andFilterWhere(['like', 'user_name', $this->user_name])->orderBy([
                'msg_time' => SORT_DESC
            ]);

        return $dataProvider;
    }
}
