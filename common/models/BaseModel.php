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
class BaseModel extends \yii\db\ActiveRecord
{

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if ($this->isNewRecord)
        {
            $this->created_at = new \yii\db\Expression('NOW()');
            $this->updated_at = new \yii\db\Expression('NOW()');
            $this->created_user = \yii::$app->user->id;
            $this->updated_user = \yii::$app->user->id;
        } else
        {
            $this->updated_at = new \yii\db\Expression('NOW()');
            $this->updated_user = \yii::$app->user->id;
        }

        return true;
    }

}
