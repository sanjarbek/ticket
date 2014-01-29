<?php

namespace frontend\controllers;

use common\models\Ticket;
use common\models\TicketQuery;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\AccessDeniedHttpException;
use yii\web\VerbFilter;
use frontend\actions\ImageUploadAction;
use frontend\actions\FileUploadAction;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{

    public $layout = 'main_user.php';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\web\AccessControl::className(),
//                'only' => ['index', 'create', 'update', 'view', 'delete'],
                'rules' => [
                    'authorized_access' => [
                        'actions' => [
                            'index',
                            'view',
                            'update',
                            'stupdate',
                            'create',
                            'imageupload',
                            'fileupload',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    'guest_access' => [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'imageupload' => [
                'class' => ImageUploadAction::className(),
                'uploadPath' => \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR,
                'uploadUrl' => '/uploads/images',
                'uploadCreate' => true,
                'permissions' => 0755,
            ],
            'fileupload' => [
                'class' => FileUploadAction::className(),
                'uploadPath' => \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR,
                'uploadUrl' => '/uploads/files',
                'uploadCreate' => true,
                'permissions' => 0755,
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = User::find(\yii::$app->user->id);
//        if ( $user->role == User::ROLE_USER)
//            $this->layout = 'main_user.php';
//        else
//            $this->layout = 'main_tech.php';
        $searchModel = new TicketQuery;


        if ($user->role == User::ROLE_USER)
            $_GET['TicketQuery']['created_user'] = \yii::$app->user->id;

        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'iframe-main.php';
        $ticket = Ticket::find($id);
        $comment = new \common\models\Comment();
        $comment = $this->newComment($ticket);
        return $this->render('view', [
                'model' => $ticket,
                'comment' => $comment,
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'iframe-main.php';

        if (User::find(\yii::$app->user->id)->role != User::ROLE_USER)
            throw new AccessDeniedHttpException('Только простые пользователи могут заводить новую заявку.');

        $model = new Ticket;

        $model->status_id = 1;

        if ($model->load($_POST) && $model->save())
        {
            $statusLog = new \common\models\StatusLog();
            $statusLog->status_id = 1;
            $statusLog->ticket_id = $model->id;
            $statusLog->begin_at = new \yii\db\Expression('NOW()');
            $statusLog->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'iframe-main.php';

        $model = $this->findModel($id);
        $model->scenario = 'update';
        $user = User::find(\yii::$app->user->id);

        // Проверка пользователя на права редактирования заявки
        if ($user->role != User::ROLE_USER && $model->created_user != $user->id)
            throw new AccessDeniedHttpException('Доступ закрыт.');

        if ($model->status_id == Ticket::STATUS_FINISHED)
            throw new AccessDeniedHttpException('Доступ для редактирования закрыта.');

        $oldModel = clone $model;
        $oldStatusLog = clone $model->currentLog;

        if ($model->load($_POST))
        {
            if ($oldModel->status_id != $model->status_id && !($oldModel->status_id == Ticket::STATUS_INPROGRESS && $model->status_id == Ticket::STATUS_FINISHED))
                throw new AccessDeniedHttpException('Вы не можете менять этот статус.');

            if ($model->save())
            {
                $newStatusLog = new \common\models\StatusLog();
                $oldStatusLog->end_at = new \yii\db\Expression('NOW()');
                $oldStatusLog->save();
                $newStatusLog->ticket_id = $model->id;
                $newStatusLog->status_id = $model->status_id;
                $newStatusLog->begin_at = $oldStatusLog->end_at;
                $newStatusLog->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else
            {
                return $this->render('update', [
                        'model' => $model,
                ]);
            }
        } else
        {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionStupdate($id)
    {
        $this->layout = 'iframe-main.php';

        if (!\yii::$app->request->isAjax)
            throw new AccessDeniedHttpException('Only ajax request will be accepted.');

        $model = $this->findModel($id);
        $model->scenario = 'updateStatus';

        $user = User::find(\yii::$app->user->id);

        if ($model->status_id == Ticket::STATUS_FINISHED)
            throw new AccessDeniedHttpException('Forbidden for edit.');

        $oldModel = clone $model;
        $oldStatusLog = clone $model->currentLog;

        $error = TRUE;
        if ($model->load($_POST))
        {
            if ($user->role == User::ROLE_USER)
            {
                if ($user->id == $model->created_user && $oldModel->status_id == Ticket::STATUS_INPROGRESS && $model->status_id == Ticket::STATUS_FINISHED)
                {
                    $error = FALSE;
                }
            } else if ($user->role == User::ROLE_TECHNICIAN)
            {

                if ($oldModel->status_id == Ticket::STATUS_INPROGRESS && $model->status_id == Ticket::STATUS_NEW && $oldModel->currentLog->created_user == $user->id)
                {
                    $error = FALSE;
                } else if ($oldModel->status_id == Ticket::STATUS_NEW && $model->status_id == Ticket::STATUS_INPROGRESS)
                {
                    $error = FALSE;
                }
            }
            if (!$error)
            {
                if ($model->save())
                {
                    $newStatusLog = new \common\models\StatusLog();
                    $oldStatusLog->end_at = new \yii\db\Expression('NOW()');
                    $oldStatusLog->save();
                    $newStatusLog->ticket_id = $model->id;
                    $newStatusLog->status_id = $model->status_id;
                    $newStatusLog->begin_at = $oldStatusLog->end_at;
                    $newStatusLog->save();
//                    echo \yii\helpers\Json::encode('Заявка принята.');
                    return \yii\helpers\Json::encode('Finished successfully.');
                } else
                {
                    return \yii\helpers\Json::encode('There is error on saving.');
                }
            } else
            {
//                return \yii\helpers\Json::encode('У вас нехватает прав доступа для выполнения данного действия.');
                return \yii\helpers\Json::encode('You do not have enough permissions to make this operation.');
            }
        }
//            return \yii\helpers\Json::encode('Произошла ошибка при загрузке данных.');
        return \yii\helpers\Json::encode('There is error on loading datas.');
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id !== null && ($model = Ticket::find($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function newComment($post)
    {
        $comment = new \common\models\Comment();
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form')
        {
            echo \yii\widgets\ActiveForm::validate($comment);
            Yii::app()->end();
        }
        if (isset($_POST['Comment']))
        {
            $comment->attributes = $_POST['Comment'];
            if ($post->addComment($comment))
            {
                $this->refresh();
            }
        }
        return $comment;
    }

}
