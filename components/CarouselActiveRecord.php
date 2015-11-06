<?php

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use app\models\Settings;
use himiklab\sortablegrid\SortableGridBehavior;
use yii\web\UploadedFile;

class CarouselActiveRecord extends ActiveRecord
{
    const STATUS_ON  = 1;
    const STATUS_OFF = 0;

    public static $defaultPageSize = 10;

    public $image_tmp;

    protected $sort_attribute = 'sort_order';
    protected $image_attribute = 'image';

    public function init()
    {
        parent::init();

        $pageSize = Settings::findOne(['type' => Settings::TYPE_MAIN, 'key' => 'page_size']);

        if ($pageSize !== null)
            self::$defaultPageSize = (int)$pageSize->value;
    }

    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => $this->sort_attribute
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->image_tmp !== null) {
                $imgName = $this->image_tmp->baseName . '_' . time() . '.' . $this->image_tmp->extension;
                $this->image_tmp->saveAs(\Yii::getAlias('@uploads') .'/' . $imgName);
                $this->{$this->image_attribute}= $imgName;
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->image_tmp = UploadedFile::getInstance($this, 'image_tmp');
            return true;
        } else {
            return false;
        }
    }

    public static function statuses()
    {
        return [
            self::STATUS_ON => Yii::t('app', 'status_on'),
            self::STATUS_OFF => Yii::t('app', 'status_off'),
        ];
    }
}