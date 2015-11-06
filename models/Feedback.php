<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $phone
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Feedback extends \yii\db\ActiveRecord
{
    const STATUS_CONFIRMED = 1;
    const STATUS_UNCONFIRMED = 0;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => 'updated_at',
//                'value' => new Expression('NOW()'),
                'value' => function(){
                    return date("d/m/Y H:i:s");
                }
//            'format' => ['date', 'php:d/m/Y H:i:s']

            ]

//            'value' => time(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            //[['created_at', 'updated_at'], 'safe'],
            ['phone', 'required'],
            [['phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function statuses()
    {
        return [
            self::STATUS_CONFIRMED => Yii::t('app', 'status_confirmed'),
            self::STATUS_UNCONFIRMED => Yii::t('app', 'status_unconfirmed'),
        ];
    }

    /*public static function search()
    {
        $pageSize = Settings::findOne(['type' => 'main', 'key' => 'page_size']);

        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => isset($pageSize->value) ? $pageSize->value : 10
            ],
        ]);

        return $dataProvider;
    }*/

    public static function unconfirmedCount()
    {
        return self::find()->where(['status' => self::STATUS_UNCONFIRMED])->count();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert === true)
                $this->status = self::STATUS_UNCONFIRMED;
            return true;
        } else {
            return false;
        }
    }
}
