<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $login;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'targetClass' => '\app\models\UserModel', 'message' => Yii::t('app', 'This login has already been taken')],
            ['login', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\UserModel', 'message' => Yii::t('app', 'This email address has already been taken')],
            ['password', 'required'],
            ['password', 'string', 'min' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => Yii::t('app', 'Login'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new UserModel;
            $user->login = $this->login;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }
        return null;
    }
}