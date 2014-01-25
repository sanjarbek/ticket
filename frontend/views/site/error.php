<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */
$this->title = $name;
?>
<div class=" panel panel-primary site-error">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
    </div>
</div>
