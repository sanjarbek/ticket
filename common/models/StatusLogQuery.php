<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StatusLog;

/**
 * StatusLogQuery represents the model behind the search form about StatusLog.
 */
class StatusLogQuery extends Model
{

    public $id;
    public $ticket_id;
    public $status_id;
    public $begin_at;
    public $end_at;
    public $created_at;
    public $updated_at;
    public $created_user;
    public $updated_user;

    public function rules()
    {
        return [
            [['id', 'ticket_id', 'status_id', 'created_user', 'updated_user'], 'integer'],
            [['begin_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => '№ Заявки',
            'status_id' => 'Статус',
            'begin_at' => 'Дата начало',
            'end_at' => 'Дата конца',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

    public function search($params)
    {
        $query = StatusLog::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'ticket_id');
        $this->addCondition($query, 'status_id');
        $this->addCondition($query, 'begin_at');
        $this->addCondition($query, 'end_at');
        $this->addCondition($query, 'created_at');
        $this->addCondition($query, 'updated_at');
        $this->addCondition($query, 'created_user');
        $this->addCondition($query, 'updated_user');
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '')
        {
            return;
        }
        if ($partialMatch)
        {
            $query->andWhere(['like', $attribute, $value]);
        } else
        {
            $query->andWhere([$attribute => $value]);
        }
    }

}
