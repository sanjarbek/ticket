<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CommentQuery $searchModel
 */
$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p class="pull-right">
        <?= Html::a('Создать комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'ticket_id',
            'content',
//            'created_at',
//            'updated_at',
            // 'created_user',
            // 'updated_user',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
