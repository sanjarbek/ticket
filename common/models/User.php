<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package common\models
 *
 * @property integer $id
 * @property string $firstname
 * @property string $secondname
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * @var string the raw password. Used to collect password input and isn't saved in database
     */
    public $password;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_ADMIN = 0;
    const ROLE_MODERATOR = 1;
    const ROLE_TECHNICIAN = 2;
    const ROLE_USER = 3;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\AutoTimestamp',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
            ],
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::find($id);
    }

    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return null|User
     */
    public static function findByUsername($username)
    {
        return static::find(['username' => $username, 'status' => static::STATUS_ACTIVE]);
    }

    /**
     * @return int|string|array current user ID
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'secondname' => 'Фамилия',
            'username' => 'Логин',
            'password' => 'Пароль',
            'role' => 'Роль',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата редактирования',
        ];
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_MODERATOR, self::ROLE_TECHNICIAN, self::ROLE_USER]],
            ['firstname', 'filter', 'filter' => 'trim'],
            ['firstname', 'required'],
            ['firstname', 'string', 'min' => 3, 'max' => 30],
            ['secondname', 'filter', 'filter' => 'trim'],
            ['secondname', 'required'],
            ['secondname', 'string', 'min' => 3, 'max' => 30],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 15],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'This email address has already been taken.', 'on' => 'signup'],
            ['email', 'exist', 'message' => 'There is no user with such email.', 'on' => 'requestPasswordResetToken'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['firstname', 'secondname', 'username', 'email', 'password', '!status', 'role'],
            'updateProfile' => ['firstname', 'secondname', 'username', 'email', 'status', 'role'],
            'resetPassword' => ['password'],
            'requestPasswordResetToken' => ['email'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if (($this->isNewRecord || $this->getScenario() === 'resetPassword') && !empty($this->password))
            {
                $this->password_hash = Security::generatePasswordHash($this->password);
            }
            if ($this->isNewRecord)
            {
                $this->auth_key = Security::generateRandomKey();
            }
            return true;
        }
        return false;
    }

    static public function getStatusOptions()
    {
        return array(
            self::STATUS_DELETED => 'Неактивный',
            self::STATUS_ACTIVE => 'Активный',
        );
    }

    /**
     *
     * @return status text presentation
     */
    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return (isset($statusOptions[$this->status]) ?
                $statusOptions[$this->status] :
                \yii::t('status', 'Неизвестный статус: ') . $this->status);
    }

    static public function getRoleOptions()
    {
        return [
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_TECHNICIAN => 'Тех. поддержка',
            self::ROLE_USER => 'Пользователь',
        ];
    }

    /**
     *
     * @return role text presentation
     */
    public function getRoleText()
    {
        $roleOptions = $this->getRoleOptions();
        return (isset($roleOptions[$this->role]) ?
                $roleOptions[$this->role] :
                \yii::t('status', 'Неизвестный статус: ') . $this->role);
    }

    public function showName()
    {
        return $this->secondname . ' ' . $this->firstname;
    }

}
