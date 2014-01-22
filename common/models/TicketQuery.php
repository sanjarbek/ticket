<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketQuery represents the model behind the search form about Ticket.
 */
class TicketQuery extends Model
{

    public $id;
    public $category_id;
    public $title;
    public $content;
    public $status_id;
    public $created_at;
    public $updated_at;
    public $created_user;
    public $updated_user;

    public function rules()
    {
        return [
            [['id', 'category_id', 'status_id', 'created_user', 'updated_user'], 'integer'],
            [['title', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'title' => 'Заголовок заявки',
            'content' => 'Описание',
            'status_id' => 'Статус',
            'created_at' => 'Дата заявки',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

    public function search($params)
    {
        $query = Ticket::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'category_id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'content', true);
        $this->addCondition($query, 'status_id');
        $this->addCondition($query, 'created_at', true);
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
