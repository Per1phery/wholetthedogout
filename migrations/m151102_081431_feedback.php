<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_081431_feedback extends Migration
{
    public function up()
    {
        $this->createTable('feedback', [
            'id' => Schema::TYPE_PK,
            'phone' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_BOOLEAN,
            'created_at' => Schema::TYPE_STRING,
            'updated_at' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('feedback');
    }
}
