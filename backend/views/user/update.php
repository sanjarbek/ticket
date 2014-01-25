<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */
$this->title = 'Редактировать пользователя: ' . $model->showName();
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->showName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
