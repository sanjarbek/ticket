<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Status $model
 */
$this->title = 'Редактировать статус: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
