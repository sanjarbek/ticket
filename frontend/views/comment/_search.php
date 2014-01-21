<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\CommentQuery $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-search">

    <?php
    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ticket_id') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'created_user') ?>

    <?php // echo $form->field($model, 'updated_user')  ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
