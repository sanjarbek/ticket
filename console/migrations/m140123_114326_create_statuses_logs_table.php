<?php

use yii\db\Schema;

class m140123_114326_create_statuses_logs_table extends \yii\db\Migration
{

    public function up()
    {
        $this->createTable('status_logs', [
            'id' => Schema::TYPE_PK,
            'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'begin_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'end_at' => Schema::TYPE_DATETIME . ' NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('status_logs');
    }

}
