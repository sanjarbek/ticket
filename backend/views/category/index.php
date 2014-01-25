<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CategoryQuery $searchModel
 */
$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary ticket-index">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode('Список категорий') ?>
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'pull-right']) ?>

        </h3>
    </div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'pager' => [
            'class' => 'yii\widgets\LinkPager',
            'maxButtonCount' => 5,
            'options' => [
                'class' => 'pagination pagination-sm',
                'style' => 'margin-left: 10px; margin-top: 0px; margin-bottom: 5px;',
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function($data)
            {
                return $data->parent->title;
            }
            ],
            'title',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
