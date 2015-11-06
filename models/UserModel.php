<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "userModel".
 *
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserModel extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const SCENARIO_PROFILE = 'profile';
    const SCENARIO_CHANGE_PASSWORD = 'changePassword';
    const SCENARIO_SIGNUP = 'signup';

    public $password;
    public $confirmPassword;
    public $oldPassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userModel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'message' => Yii::t('app', 'This login has already been taken')],
            ['login', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => Yii::t('app', 'This email address has already been taken')],

            ['password', 'required'],
            ['password', 'string', 'min' => 5],

            ['confirmPassword', 'required'],
            ['confirmPassword', 'string', 'min' => 5],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],

            ['oldPassword', 'required'],
            ['oldPassword', 'oldPasswordValidator'],
        ];
    }

    public function oldPasswordValidator($attribute, $params)
    {
        if (!$this->validatePassword($this->$attribute))
            $this->addError($attribute, 'Old password is incorrect');
        return true;
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_PROFILE => ['login', 'email'],
            self::SCENARIO_CHANGE_PASSWORD => ['oldPassword', 'password', 'confirmPassword'],
            self::SCENARIO_SIGNUP => ['login', 'email', 'password', 'confirmPassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by login
     *
     * @param  string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert))
            return false;

        if ($this->validate() && !empty($this->password))
            $this->setPassword($this->password);

        if ($insert) {
            $this->generateAuthKey();
        }

        return true;
    }

    public static function search()
    {
        $pageSize = Settings::findOne(['type' => 'main', 'key' => 'page_size']);

        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
            'sort' => [
                'defaultOrder' => [
                    'login' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => isset($pageSize->value) ? $pageSize->value : 10
            ],
        ]);

        return $dataProvider;
    }
}
