<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\UserQuery $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'firstname') ?>

		<?= $form->field($model, 'secondname') ?>

		<?= $form->field($model, 'username') ?>

		<?= $form->field($model, 'auth_key') ?>

		<?php // echo $form->field($model, 'password_hash') ?>

		<?php // echo $form->field($model, 'password_reset_token') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'role') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'create_time') ?>

		<?php // echo $form->field($model, 'update_time') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
