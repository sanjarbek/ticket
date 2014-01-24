<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\StatusLog $model
 */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'История изменений статусов заявок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-log-view">

    <h1>Заявка: <?= Html::encode($model->ticket->id) ?></h1>

    <p class="pull-right">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
//            'data-method' => 'post',
//        ]);
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'name' => 'ticket_id',
                'value' => $model->ticket->title,
            ],
            [
                'name' => 'status_id',
                'value' => $model->status->name,
            ],
            'begin_at',
            'end_at',
            'created_at',
            'updated_at',
            [
                'name' => 'created_user',
                'value' => $model->createdUser->showName(),
            ],
            [
                'name' => 'updated_user',
                'value' => $model->updatedUser->showName(),
            ],
        ],
    ]);
    ?>

</div>
