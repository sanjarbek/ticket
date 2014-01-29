<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'comment-form',
            'enableAjaxValidation' => false,
    ]);
    ?>

    <?php // $form->field($model, 'ticket_id', ['template' => '{input}'])->input('hidden') ?>

    <div class="form-group">
        <label class="control-label" for="ticket-content">Новый комментарий:</label>
        <?php
        echo yii\imperavi\Widget::widget([
            'model' => $model,
            'attribute' => 'content',
            'options' => [
                'buttons' => ['html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'file', 'table', '|', 'alignment', '|', 'horizontalrule'],
                'toolbar' => true,
                'fullscreen' => true,
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
