<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $type
 * @property string $key
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
   const TYPE_MAIN = 'main';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Title'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function search()
    {
        $pageSize = self::findOne(['type' => self::TYPE_MAIN, 'key' => 'page_size']);

        $dataProvider = new ActiveDataProvider([
            'query' => self::find()->where(['type' => self::TYPE_MAIN]),
            'sort' => [
                'defaultOrder' => [
                    'title' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => isset($pageSize->value) ? $pageSize->value : 10
            ],
        ]);

        return $dataProvider;
    }
}
