<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 */
$this->title = 'Создать новую категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
