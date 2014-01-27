<?php

namespace frontend\actions;

use yii\base\Action;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\helpers\Json;

/**
 * Redactor widget image upload action.
 *
 * @param string $attr Model attribute
 * @throws CHttpException
 */
class ImageUploadAction extends Action
{

    public $uploadPath;
    public $uploadUrl;
    public $uploadCreate = false;
    public $permissions = 0775;

    public function run()
    {
        if ($this->uploadPath === null)
        {
            $uploadPath = \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            $uploadPath = realpath($uploadPath);
            if ($this->uploadPath === false && $this->uploadCreate === true)
            {
                if (!mkdir($path, $this->permissions, true))
                {
                    throw new HttpException(500, Json::encode(
                        ['error' => 'Could not create upload folder "' . $path . '".']
                    ));
                }
            }
        }
        if ($this->uploadUrl === null)
        {
            $this->uploadUrl = '/images';
        }

        $file = UploadedFile::getInstanceByName('file');
        if ($file instanceof UploadedFile)
        {
            if (!in_array(strtolower($file->getExtension()), array('gif', 'png', 'jpg', 'jpeg')))
            {
                throw new HttpException(500, Json::encode(
                    ['error' => 'Invalid file extension ' . $file->getExtension() . '.']
                ));
            }
            $fileName = trim(md5('image_' . time() . uniqid(rand(), true))) . '.' . $file->getExtension();
            $path = $this->uploadPath . DIRECTORY_SEPARATOR . $fileName;
            if (file_exists($path) || !$file->saveAs($path))
            {
                throw new HttpException(500, Json::encode(
                    ['error' => 'Could not save file or file exists: "' . $path . '".']
                ));
            }
            $url = $this->uploadUrl . '/' . $fileName;
            $data = [
                'filelink' => $url,
            ];
            return Json::encode($data);
        } else
        {
            throw new HttpException(500, Json::encode(
                ['error' => 'Could not upload file.']
            ));
        }
    }

}
