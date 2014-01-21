<?php

namespace common\models;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class Ticket extends BaseModel
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
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'status_id', 'created_user', 'updated_user'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['created_at', 'updated_at'], 'safe'],
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
            'title' => 'Заголовок',
            'content' => 'Описание',
            'status_id' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'created_user' => 'Создал',
            'updated_user' => 'Редактировал',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoriesList()
    {
        $categories = Category::find()->select(['id', 'title'])
            ->where('parent_id<>0')
            ->orderBy('title')
            ->all();

        $categoriesArray = array();
        foreach ($categories as $key => $category)
            $categoriesArray[$category->id] = $category->title;

        return $categoriesArray;
    }

    static public function getStatusesList()
    {
        $statuses = Status::find()->all();
        $statusArray = array();
        foreach ($statuses as $key => $status)
            $statusArray[$status->id] = $status->name;

        return $statusArray;
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function addComment($comment)
    {
        $comment->ticket_id = $this->id;
        return $comment->save();
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['ticket_id' => 'id']);
    }

}
