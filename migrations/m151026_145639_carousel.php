<?php

use yii\db\Schema;
use yii\db\Migration;

class m151026_145639_carousel extends Migration
{
    public function up()
    {
        $this->createTable('carousel', [
            'id' => Schema::TYPE_PK,
            'image' => Schema::TYPE_STRING,
            'link' => Schema::TYPE_STRING,
            'sort_order' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_BOOLEAN,
        ]);
    }

    public function down()
    {
        $this->dropTable('carousel');
    }
}
