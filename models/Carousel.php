<?php

namespace app\models;

use Yii;
use app\components\CarouselActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "carousel".
 *
 * @property integer $id
 * @property string $image
 * @property string $link
 * @property integer $order
 * @property integer $status
 */
class Carousel extends CarouselActiveRecord
{
    const SCENARIO_INSERT = 'insert';

    protected $folderName = 'carousel';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carousel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'integer'],
            ['link', 'url'],
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
            'id' => 'ID',
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function search()
    {
        $pageSizeSetting = Settings::findOne(['type' => Settings::TYPE_MAIN, 'key' => 'page_size']);
        $page = (!is_null($pageSizeSetting)) ? $pageSizeSetting->value : self::$defaultPageSize;

        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
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
