<?php

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use app\models\Settings;
use himiklab\sortablegrid\SortableGridBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

class CarouselActiveRecord extends ActiveRecord
{
    const STATUS_ON  = 1;
    const STATUS_OFF = 0;

    public static $defaultPageSize = 10;

    public $image_tmp;

    protected $folderName = 'temp';
    protected $sort_attribute = 'sort_order';
    protected $image_attribute = 'image';


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
                $imgName = $this->getImageName();
                $path = $this->getUploadsPath(). DIRECTORY_SEPARATOR . $imgName;
                $this->image_tmp->saveAs($path);
                $this->{$this->image_attribute} = $imgName;
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

    public function getImageName()
    {
        return $this->image_tmp->baseName . '_' . time() . '.' . $this->image_tmp->extension;
    }

    public static function statuses()
    {
        return [
            self::STATUS_ON => Yii::t('app', 'status_on'),
            self::STATUS_OFF => Yii::t('app', 'status_off'),
        ];
    }

    protected function createThumbnail($width, $height)
    {
        $imgName = $this->image;
        $path = $this->getUploadsPath(). DIRECTORY_SEPARATOR . $imgName;

        Image::thumbnail($path, $width, $height)->save($this->getThumbPath($width, $height) . DIRECTORY_SEPARATOR . $imgName);
    }

    protected function getUploadsPath()
    {
        $path = \Yii::getAlias('@app/web/uploads') . DIRECTORY_SEPARATOR . $this->folderName;
        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0777);
        }

        return $path;
    }

    protected function getThumbPath($width, $height)
    {
        $path = \Yii::getAlias('@app/web/uploads/thumbs') . DIRECTORY_SEPARATOR . $this->folderName . DIRECTORY_SEPARATOR . $width . 'x' . $height;

        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0777);
        }

        return $path;
    }

    public function getThumbImage($width, $height)
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = $this->getThumbPath($width, $height) . $ds . $this->image;

        if (!file_exists($path)) {
            $this->createThumbnail($width, $height);
        }

        return Yii::getAlias('@web/uploads/thumbs') . $ds . $this->folderName . $ds . $width . 'x' . $height . $ds . $this->image;
    }
}