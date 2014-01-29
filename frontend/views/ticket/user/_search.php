<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

/**
 * @var yii\web\View $this
 * @var common\models\TicketQuery $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ticket-search">

    <?php
    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'type' => ActiveForm::TYPE_VERTICAL,
    ]);
    ?>
    <?php echo $form->field($model, 'status_id', ['template' => '{input}'])->input('hidden') ?>
    <?php
    echo $form->field($model, 'category_id')
        ->dropDownList(common\models\Ticket::getCategoriesList(), [
            'prompt' => 'Выберите категорию...'
    ]);
    ?>
    <?php
//    echo Select2::widget([
//        'model' => $model,
//        'attribute' => 'category_id',
//        'form' => $form,
//        'data' => common\models\Ticket::getCategoriesList(),
//        'options' => [
//            'placeholder' => 'Выберите категорию...'
//        ],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]);
    ?>

    <?php // echo $form->field($model, 'title')    ?>

    <?php // echo $form->field($model, 'content')     ?>

    <?php // echo $form->field($model, 'status_id')     ?>

    <?php // echo $form->field($model, 'created_at')    ?>

    <?php
//    echo DatePicker::widget([
//        'model' => $model,
//        'form' => $form,
//        'attribute' => 'created_at',
//        'options' => [
//            'placeholder' => 'Выберите дату заявки...',
//        ],
//        'pluginOptions' => [
//            'language' => 'ru',
//            'format' => 'yyyy-mm-dd',
//            'todayHighlight' => true,
//            'autoclose' => true
//        ]
//    ]);
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'from_date',
        'attribute2' => 'to_date',
        'form' => $form,
        'type' => DatePicker::TYPE_RANGE,
        'separator' => 'по',
        'pluginOptions' => [
            'language' => 'ru',
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ]);
    ?>

    <div class="form-group pull-right">
        <?= Html::submitButton('Применить фильтр', ['class' => 'btn btn-sm btn-primary']) ?>
        <?php // echo Html::resetButton('Очистить', ['class' => 'btn btn-sm btn-default']) ?>
    </div>
    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
