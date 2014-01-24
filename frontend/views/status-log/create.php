<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\StatusLog $model
 */

$this->title = 'Create Status Log';
$this->params['breadcrumbs'][] = ['label' => 'Status Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-log-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
