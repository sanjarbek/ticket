<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Status $model
 */
$this->title = 'Создать новый статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
