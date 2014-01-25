<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary ticket-index">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode($this->title) ?>
            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'pull-right']) ?>
            <?php
//            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
//                'class' => 'btn btn-danger',
//                'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
//                'data-method' => 'post',
//            ]);
            ?>
        </h3>
    </div>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'attributes' => [
            'id',
            [
                'name' => 'parent_id',
                'value' => $model->parent->title,
            ],
            'title',
            'created_at',
            'updated_at',
            [
                'name' => 'created_user',
                'value' => $model->createdUser->showName()
            ],
            [
                'name' => 'updated_user',
                'value' => $model->updatedUser->showName()
            ],
        ],
    ]);
    ?>

</div>
