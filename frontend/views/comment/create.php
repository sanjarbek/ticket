<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 */
$this->title = 'Создать комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
