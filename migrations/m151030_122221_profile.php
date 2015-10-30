<?php

use yii\db\Schema;
use yii\db\Migration;

class m151030_122221_profile extends Migration
{
    public function up()
    {
        $this->createTable('profile', [
            'id' => Schema::TYPE_PK,
            'image' => Schema::TYPE_STRING,
            'full_name' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING,
            'sort_order' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_BOOLEAN,
        ]);
    }

    public function down()
    {
        $this->dropTable('profile');
    }
}
