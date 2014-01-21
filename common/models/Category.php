<?php

namespace common\models;

use yii\base\Model;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class Category extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_user', 'updated_user'], 'integer'],
            [['parent_id', 'title'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
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
            'parent_id' => 'Родительская категория',
            'title' => 'Заголовок',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['id' => 'category_id']);
    }

    public function getCategoriesList()
    {
        $categories = Category::find()->select(['id', 'title'])
            ->orderBy('title')
            ->all();

        $categoriesArray = array();
        foreach ($categories as $key => $category)
            $categoriesArray[$category->id] = $category->title;

        return $categoriesArray;
    }

    public function getParent()
    {
        if ($this->id == 1)
            return $this;
        return Category::find($this->parent_id);
    }

}
