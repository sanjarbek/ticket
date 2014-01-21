<?php

namespace common\models;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class Comment extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'created_user', 'updated_user'], 'integer'],
            [['content'], 'required'],
            [['created_at', 'updated_at', 'created_user', 'updated_user'], 'safe'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Номер заявки',
            'content' => 'Описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

}
