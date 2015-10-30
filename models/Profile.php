<?php

namespace app\models;

use Yii;
use app\components\CarouselActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $image
 * @property string $full_name
 * @property string $description
 * @property integer $sort_order
 * @property integer $status
 */
class Profile extends CarouselActiveRecord
{
    const SCENARIO_INSERT = 'insert';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
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
            'full_name' => Yii::t('app', 'Full Name'),
            'description' => Yii::t('app', 'Description'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function search()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
            'sort' => [
                'defaultOrder' => [
                    'sort_order' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::$defaultPageSize
            ],
        ]);

        return $dataProvider;
    }
}
