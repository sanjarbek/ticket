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

    const STATUS_NEW = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_FINISHED = 3;

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
            ['status_id', 'in', 'range' => [
                    self::STATUS_NEW,
                    self::STATUS_INPROGRESS,
                    self::STATUS_FINISHED,
                ]
            ],
            [['category_id'],
                'exist',
                'targetClass' => Category::className(),
                'targetAttribute' => 'id',
                'message' => 'Такой категории не существует',
                'skipOnError' => false,
            ],
            [['title'], 'string', 'max' => 100],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['category_id', 'title', 'content'],
            'update' => ['category_id', 'title', 'content'],
            'updateStatus' => ['status_id'],
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
            'title' => 'Тема',
            'content' => 'Вопрос',
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

    static public function getCategoriesList()
    {
        $categories = Category::find()->select(['id', 'title'])
            ->where('parent_id<>0')
            ->orderBy('title')
            ->all();

        $categoriesArray = [];
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

    public function getCurrentLog()
    {
        return $this->hasOne(StatusLog::className(), ['ticket_id' => 'id', 'status_id' => 'status_id']);
    }

    static public function getStatusOptions()
    {
        return array(
            self::STATUS_NEW => 'Новый',
            self::STATUS_INPROGRESS => 'Принят',
            self::STATUS_FINISHED => 'Закончен',
        );
    }

    /**
     *
     * @return status text presentation
     */
    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return (isset($statusOptions[$this->status_id]) ?
                $statusOptions[$this->status_id] :
                \yii::t('status', 'Неизвестный статус: ') . $this->status_id);
    }

    static public function getCreatedUsersList()
    {
        $users = User::find()->where(['role' => User::ROLE_USER])->all();

        $usersArray = array();
        foreach ($users as $key => $user)
            $usersArray["$user->id"] = $user->showName();

        return $usersArray;
    }

}
