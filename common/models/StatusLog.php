<?php

namespace common\models;

/**
 * This is the model class for table "status_logs".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $status_id
 * @property string $begin_at
 * @property string $end_at
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class StatusLog extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'status_id', 'begin_at'], 'required'],
            [['ticket_id', 'status_id', 'created_user', 'updated_user'], 'integer'],
            [['begin_at', 'end_at', 'created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Заявка',
            'status_id' => 'Статус',
            'begin_at' => 'Дата начало',
            'end_at' => 'Дата конца',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

}
