<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 */
$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php
            echo $model->id . '. ';
            echo Html::encode($this->title);
            ?>
            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'pull-right']) ?>
        </h3>
    </div>
    <div class="panel-body">
        <div>
            <p class="pull-left small"><strong>Создал: </strong><i><?= $model->createdUser->showName() ?></i></p>
        </div>
        <div class="clearfix"></div>
        <div>
            <p class="pull-left small"><strong>Дата создания: </strong><?= date('d.m.Y H:i:s', strtotime($model->created_at)) ?> </p>
        </div>
        <div class="clearfix"></div>
        <div>
            <p class="pull-left small"><strong>Статус: </strong><?= $model->status->name; ?></p>
            <p class="pull-right small"><strong>Статус изменил: </strong><?= $model->createdUser->showName(); ?></p>
        </div>
        <div class="clearfix"></div>
        <hr />

        <p><strong>Вопрос</strong></p>
        <p>
            <?php
            echo $model->content;
            ?>
        </p>
        <hr />
        <div id="comments">
            <?php
            echo $this->render('_comments', array(
                'ticket' => $model,
                'comments' => $model->comments,
            ));
            ?>
            <hr>
            <h3>Добавить новый комментарий</h3>

            <?php // if (Yii::app()->user->hasFlash('commentSubmitted')):       ?>
            <!--        <div class="flash-success">
            <?php // echo Yii::app()->user->getFlash('commentSubmitted');       ?>
                    </div>-->

            <?php
            echo $this->render('/comment/_form', [
                'model' => $comment,
            ]);
            ?>
        </div><!-- comments -->
    </div>
</div>
