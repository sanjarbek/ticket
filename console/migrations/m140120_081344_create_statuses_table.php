<?php

use yii\db\Schema;

class m140120_081344_create_statuses_table extends \yii\db\Migration
{

    public function up()
    {
        $this->createTable('statuses', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(30) NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->insert('statuses', [
            'name' => 'Новый',
            'created_at' => new \yii\db\Expression('NOW()'),
            'updated_at' => new \yii\db\Expression('NOW()'),
            'created_user' => 1,
            'updated_user' => 1,
        ]);
        $this->insert('statuses', [
            'name' => 'Просмотрен',
            'created_at' => new \yii\db\Expression('NOW()'),
            'updated_at' => new \yii\db\Expression('NOW()'),
            'created_user' => 1,
            'updated_user' => 1,
        ]);
        $this->insert('statuses', [
            'name' => 'В процессе',
            'created_at' => new \yii\db\Expression('NOW()'),
            'updated_at' => new \yii\db\Expression('NOW()'),
            'created_user' => 1,
            'updated_user' => 1,
        ]);
        $this->insert('statuses', [
            'name' => 'Завершен',
            'created_at' => new \yii\db\Expression('NOW()'),
            'updated_at' => new \yii\db\Expression('NOW()'),
            'created_user' => 1,
            'updated_user' => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable('statuses');
    }

}
