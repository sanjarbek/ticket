<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]);
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'name' => 'category_id',
                'value' => $model->category->title,
            ],
            'title',
            'content:ntext',
            [
                'name' => 'status_id',
                'value' => $model->status->name,
            ],
            'created_at',
            'updated_at',
            [
                'name' => 'created_user',
                'value' => $model->createdUser->username,
            ],
            [
                'name' => 'updated_user',
                'value' => $model->updatedUser->username,
            ],
        ],
    ]);
    ?>
    <div id="comments">
        <?php
        echo $this->render('_comments', array(
            'ticket' => $model,
            'comments' => $model->comments,
        ));
        ?>

        <h3>Добавить новый комментарий</h3>

        <?php // if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <!--        <div class="flash-success">
        <?php // echo Yii::app()->user->getFlash('commentSubmitted'); ?>
                </div>-->
        <hr>
        <?php
        echo $this->render('/comment/_form', [
            'model' => $comment,
        ]);
        ?>
    </div><!-- comments -->
</div>
