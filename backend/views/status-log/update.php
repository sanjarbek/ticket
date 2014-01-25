<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\StatusLog $model
 */

$this->title = 'Update Status Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Status Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-log-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
