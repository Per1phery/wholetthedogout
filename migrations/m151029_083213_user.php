<?php

use yii\db\Schema;
use yii\db\Migration;

class m151029_083213_user extends Migration
{
    public function up()
    {
        $this->createTable('userModel', [
            'id'                   => Schema::TYPE_PK,
            'login'                => Schema::TYPE_STRING . '(255) NOT NULL',
            'email'                => Schema::TYPE_STRING . '(255) NOT NULL',
            'password_hash'        => Schema::TYPE_STRING . '(60) NOT NULL',
            'auth_key'             => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('userModel', [
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable('userModel');
    }
}
