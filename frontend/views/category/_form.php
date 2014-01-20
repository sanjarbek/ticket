<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="category-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'parent_id')->textInput() ?>

		<?= $form->field($model, 'created_user')->textInput() ?>

		<?= $form->field($model, 'updated_user')->textInput() ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

		<?= $form->field($model, 'created_at')->textInput() ?>

		<?= $form->field($model, 'updated_at')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
