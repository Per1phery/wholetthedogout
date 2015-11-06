<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $phone
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'created_at', 'status'], 'string', 'max' => 255]
        ];
    }

    public function search($params)
    {
        $query = Feedback::find();
        $pageSize = Settings::findOne(['type' => Settings::TYPE_MAIN, 'key' => 'page_size']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => isset($pageSize->value) ? $pageSize->value : 10
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'phone', $this->phone]);
        $query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }

}
