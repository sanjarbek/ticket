<?php

use yii\db\Schema;

class m140120_035302_create_categories_table extends \yii\db\Migration
{

    public function up()
    {
        $this->createTable('categories', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->insert('categories', [
            'parent_id' => 0,
            'title' => 'Главная категория',
            'created_at' => new \yii\db\Expression('NOW()'),
            'updated_at' => new \yii\db\Expression('NOW()'),
            'created_user' => 1,
            'updated_user' => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable('categories');
    }

}
