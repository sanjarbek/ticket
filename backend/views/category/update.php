<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 */
$this->title = 'Редактировать категорию: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class=" panel panel-primary ticket-index">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php
        echo $this->render('_form', [
            'model' => $model,
        ]);
        ?>

    </div>
</div>
