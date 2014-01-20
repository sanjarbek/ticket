<?php

use yii\db\Schema;

class m140118_083135_create_tickets_table extends \yii\db\Migration
{

    public function up()
    {
        $this->createTable('tickets', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'status_id' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('tickets');
    }

}
