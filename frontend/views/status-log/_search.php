<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\StatusLogQuery $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="status-log-search">
    <?php
    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'ticket_id')->textInput(['class' => 'col-6 form-control']) ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'begin_at') ?>

    <?php // echo $form->field($model, 'end_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_user') ?>

    <?php // echo $form->field($model, 'updated_user')  ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-sm btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
