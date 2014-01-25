<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\TicketQuery $searchModel
 */
$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary ticket-index">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode('Поиск') ?>
        </h3>
    </div>
    <div class="panel-body">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>
</div>
<div class=" panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode('Результат поиска') ?>
        </h3>
    </div>
    <!--<p class="pull-right">-->
    <?php // echo Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    <!--</p>-->

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{summary}{items}{pager}',
        'showHeader' => true,
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
//            'id',
//            [
//                'attribute' => 'category_id',
//                'filter' => false,
//                'value' => function($data)
//            {
//                return $data->category->title;
//            },
//            ],
            'title',
//            'content:ntext',
//            [
//                'attribute' => 'status_id',
//                'filter' => common\models\Ticket::getStatusesList(),
//                'value' => function($data)
//            {
//                return $data->status->name;
//            },
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model)
                {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                            'title' => Yii::t('yii', 'View'),
                            'onClick' => "javascript: $('#ticket-content').attr('src', '" . $url . "')",
                    ]);
                }
                ],
            ],
        ],
    ]);
    ?>
</div>
