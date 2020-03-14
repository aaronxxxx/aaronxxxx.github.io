<?php

namespace app\modules\general\message\models;

use app\common\data\ActiveDataProvider;
use yii\base\Model;

/**
 * SearchLogSearch represents the model behind the search form about `common\models\SearchLog`.
 */
class SysAnnouncementSearch extends SysAnnouncement
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
     * @param string $type
     * @return ActiveDataProvider
     */
    public function search($params,$type='')
    {
        $query = SysAnnouncement::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['end_time'] = [
            'asc' => ['end_time' => SORT_ASC],
            'desc' => ['end_time' => SORT_DESC],
        ];
        if($type == ''){
            $query->where(['type'=>null]);
        }else{
            $query->where(['type'=>'0']);
        }
        $query->orderBy([
            'sort' => SORT_DESC
        ]);
        return $dataProvider;

    }
}
