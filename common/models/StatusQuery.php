<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Status;

/**
 * StatusQuery represents the model behind the search form about Status.
 */
class StatusQuery extends Model
{
	public $id;
	public $name;
	public $created_at;
	public $updated_at;
	public $created_user;
	public $updated_user;

	public function rules()
	{
		return [
			[['id', 'created_user', 'updated_user'], 'integer'],
			[['name', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_user' => 'Created User',
			'updated_user' => 'Updated User',
		];
	}

	public function search($params)
	{
		$query = Status::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'name', true);
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
