<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ticket-form">

    <?php
    $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getCategoriesList(), ['prompt' => 'Выберите категорию...']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?php
//    $form->field($model, 'content')->textarea(['rows' => 6]);
        echo yii\imperavi\Widget::widget([
            // You can either use it for model attribute
            'model' => $model,
            'attribute' => 'content',
            // or just for input field
//        'name' => 'my_input_name',
            // Some options, see http://imperavi.com/redactor/docs/
            'options' => [
                'toolbar' => true,
                'iframe' => false,
                'uploadFields' => [
                    \yii::$app->request->csrfVar => \yii::$app->request->csrfToken,
                ],
                'imageUpload' => $this->context->createUrl('/ticket/imageupload'),
                'fileUpload' => $this->context->createUrl('/ticket/fileupload'),
            ],
        ]);
        ?>
    </div>

    <?php
    if (!$model->isNewRecord)
        echo $form->field($model, 'status_id')->dropDownList($model->getStatusesList());
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
