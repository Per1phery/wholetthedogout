<?php

use yii\db\Schema;
use yii\db\Migration;

class m151113_074039_mention extends Migration
{
    public function up()
    {
        $this->createTable('mention', [
            'id' => Schema::TYPE_PK,
            'image' => Schema::TYPE_STRING,
            'full_name' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'sort_order' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_BOOLEAN,
            'type' => Schema::TYPE_INTEGER
        ]);
    }

    public function down()
    {
        $this->dropTable('mention');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
