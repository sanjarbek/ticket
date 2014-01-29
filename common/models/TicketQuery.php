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
    public $from_date;
    public $to_date;

    public function rules()
    {
        return [
            [['id', 'category_id', 'status_id', 'created_user', 'updated_user'], 'integer'],
            [['title', 'created_at', 'from_date', 'to_date'], 'safe'],
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
            'from_date' => 'Период',
        ];
    }

    public function search($params)
    {
        $query = Ticket::find()->innerJoinWith('currentLog');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => ['created_at' => SORT_DESC],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        if (User::find(\yii::$app->user->id)->role == User::ROLE_TECHNICIAN)
        {
            if ($this->status_id != Ticket::STATUS_NEW)
            {
                // find customers together with their country and orders of status 1 
                // Customer::find()->with([ 'orders' => function($query) 
                // { $query->andWhere('status = 1'); }, 'country', ])->all();
//                $query->joinWith(['currentLog' => function($query)
//                {
                $query->andWhere(['status_logs.created_user' => \yii::$app->user->id]);
//                }]);
//                $query->join('LEFT JOIN', 'status_logs st', [
//                    'st.ticket_id' => 't.id',
//                    'st.status_id' => $this->status_id,
//                    'st.created_user' => \yii::$app->user->id,
//                ]);
//                $query->andWhere(['currentLog.created_user' => \yii::$app->user->id]);
            }
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'category_id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'content', true);
        $this->addCondition($query, 'status_id');
        $this->addCondition($query, 'created_user');
        $this->addCondition($query, 'updated_user');

        if (!isset($this->from_date) || trim($this->from_date) == '')
            $from_date = date('2014-01-01 00:00:00');
        else
            $from_date = date('Y-m-d 00:00:00', strtotime($this->from_date));

        if (!isset($this->to_date) || trim($this->to_date) == '')
            $to_date = date('Y-m-d 23:59:59', time());
        else
            $to_date = date('Y-m-d 23:59:59', strtotime($this->to_date));

        $query->andWhere(['between', 'tickets.created_at', $from_date, $to_date]);

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
            $query->andWhere(['like', 'tickets.' + $attribute, $value]);
        } else
        {
            $query->andWhere([('tickets.' . $attribute) => $value]);
        }
    }

}
