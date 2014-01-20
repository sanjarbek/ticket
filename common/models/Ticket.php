<?php

namespace common\models;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $context
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class Ticket extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tickets';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['category_id', 'title', 'context', 'created_at', 'updated_at', 'created_user', 'updated_user'], 'required'],
			[['category_id', 'status_id', 'created_at', 'updated_at', 'created_user', 'updated_user'], 'integer'],
			[['context'], 'string'],
			[['title'], 'string', 'max' => 100]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'category_id' => 'Category ID',
			'title' => 'Title',
			'context' => 'Context',
			'status_id' => 'Status ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_user' => 'Created User',
			'updated_user' => 'Updated User',
		];
	}
}
