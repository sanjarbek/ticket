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
<div class="ticket-view">
    <h3>#
        <?php
        echo $model->id . '. ';
        echo Html::encode($this->title)
        ?>
    </h3>

    <div>
        <p class="pull-left small"><strong>Создал: </strong><i><?= $model->createdUser->username ?></i></p>
        <p class="pull-right">
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?></p>
    </div>
    <div class="clearfix"></div>
    <div>
        <p class="pull-left small"><strong>Дата создания: </strong><?= date('d.m.Y H:i:s', strtotime($model->created_at)) ?> </p>
    </div>
    <div class="clearfix"></div>
    <div>
        <p class="pull-left small"><strong>Статус: </strong><?= $model->status->name; ?></p>
    </div>
    <div class="clearfix"></div>
    <hr />

    <p><strong>Описание</strong></p>
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

        <?php // if (Yii::app()->user->hasFlash('commentSubmitted')):     ?>
        <!--        <div class="flash-success">
        <?php // echo Yii::app()->user->getFlash('commentSubmitted');     ?>
                </div>-->

        <?php
        echo $this->render('/comment/_form', [
            'model' => $comment,
        ]);
        ?>
    </div><!-- comments -->
</div>
