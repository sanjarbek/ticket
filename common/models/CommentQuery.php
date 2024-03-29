<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentQuery represents the model behind the search form about Comment.
 */
class CommentQuery extends Model
{
	public $id;
	public $ticket_id;
	public $content;
	public $created_at;
	public $updated_at;
	public $created_user;
	public $updated_user;

	public function rules()
	{
		return [
			[['id', 'ticket_id', 'created_user', 'updated_user'], 'integer'],
			[['content', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'ticket_id' => 'Ticket ID',
			'content' => 'Content',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_user' => 'Created User',
			'updated_user' => 'Updated User',
		];
	}

	public function search($params)
	{
		$query = Comment::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'ticket_id');
		$this->addCondition($query, 'content', true);
		$this->addCondition($query, 'created_at');
		$this->addCondition($query, 'updated_at');
		$this->addCondition($query, 'created_user');
		$this->addCondition($query, 'updated_user');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
