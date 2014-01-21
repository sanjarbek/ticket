<?php

use yii\db\Schema;

class m140121_035105_create_comments_table extends \yii\db\Migration
{

    public function up()
    {
        $this->createTable('comments', [
            'id' => Schema::TYPE_PK,
            'ticket_id' => Schema::TYPE_INTEGER,
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('comments');
    }

}
