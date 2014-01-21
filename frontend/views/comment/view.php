<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

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
            'ticket_id',
            'content',
            'created_at',
            'updated_at',
            'created_user',
            'updated_user',
        ],
    ]);
    ?>

</div>
