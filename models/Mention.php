<?php

namespace app\models;

use app\components\CarouselActiveRecord;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "mention".
 *
 * @property integer $id
 * @property string $image
 * @property integer $sort_order
 * @property integer $status
 * @property integer $type
 */
class Mention extends CarouselActiveRecord
{
    const SCENARIO_INSERT = 'insert';

    const TYPE_PARENT = 1;
    const TYPE_CHILD = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mention';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'integer'],
            [['full_name', 'description'], 'string', 'max' => 255],
            [['full_name', 'description'], 'filter', 'filter' => 'trim'],
            [['full_name', 'description'], 'required'],
            ['image_tmp', 'image'],
            ['image_tmp', 'image', 'skipOnEmpty' => false, 'on' => self::SCENARIO_INSERT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    public static function search($type)
    {
        $pageSizeSetting = Settings::findOne(['type' => Settings::TYPE_MAIN, 'key' => 'page_size']);
        $page = (!is_null($pageSizeSetting)) ? $pageSizeSetting->value : self::$defaultPageSize;

        $dataProvider = new ActiveDataProvider([
            'query' => self::find()->where(['type' => (int)$type]),
            'sort' => [
                'defaultOrder' => [
                    'sort_order' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => $page
            ],
        ]);

        return $dataProvider;
    }
}
