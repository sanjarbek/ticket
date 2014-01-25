<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'secondname')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'role')->dropDownList($model->getRoleOptions()) ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatusOptions()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
