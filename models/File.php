<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class File extends Model
{
    const TYPE_FILE = 'file';
    const FILE_KEY = 'file';

    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['file', 'required'],
            ['file', 'file']
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstance($this, 'file');

            return true;
        } else {
            return false;
        }
    }

    public function save()
    {
        if ($this->file !== null) {
            $name = $this->file->baseName . '_' . time() . '.' . $this->file->extension;
            $this->file->saveAs(\Yii::getAlias('@uploads') .'/' . $name);
            $this->file = $name;

            $model = Settings::findOne(['type' => self::TYPE_FILE, 'key' => self::FILE_KEY]);
            $model = $model === null ? new Settings : $model;

            $model->type = self::TYPE_FILE;
            $model->title = \Yii::t('app', 'File');
            $model->key = self::FILE_KEY;
            $model->value = $name;

            return $model->save();
        }

        return false;
    }
}