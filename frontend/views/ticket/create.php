<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 */
$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary">
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
