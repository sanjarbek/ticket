<?php

namespace frontend\controllers;

use common\models\Ticket;
use common\models\TicketQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{

    public $layout = 'main.php';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'layout1.php';
        $searchModel = new TicketQuery;
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

        $oldStatusLog = $model->currentLog;


        if ($model->load($_POST) && $model->save())
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
