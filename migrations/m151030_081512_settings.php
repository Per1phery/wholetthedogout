<?php

use yii\db\Schema;
use yii\db\Migration;

class m151030_081512_settings extends Migration
{
    public function up()
    {
        $this->createTable('settings', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING,
            'title' => Schema::TYPE_STRING,
            'key' => Schema::TYPE_STRING,
            'value' => Schema::TYPE_TEXT,
        ]);

        // вшитые данные без возможности удаления из админки
        $this->batchInsert('settings',['type', 'title', 'key', 'value'],[
            ['main', 'Email', 'email_1', 'test@test.com'],
            ['main', 'Телефон', 'phone_1', '123-45-67'],
            ['main', 'Элементов на странице в админке', 'page_size', '10'],
            ['main', 'Ссылка на Facebook', 'url_fb', 'https://www.facebook.com'],
            ['main', 'Ссылка на VK', 'url_fb', 'https://vk.com'],
            ['main', 'Ссылка на YouTube', 'url_fb', 'https://www.youtube.com'],
        ]);
    }

    public function down()
    {
        $this->dropTable('settings');
    }
}
