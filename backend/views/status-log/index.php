<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\StatusLogQuery $searchModel
 */
$this->title = 'История изменений статусов заявок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode('Поиск') ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>
<div class=" panel panel-primary ticket-index">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::encode($this->title) ?>
        </h3>
    </div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{summary}{items}{pager}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'ticket_id',
                'value' => function($data)
            {
                return $data->ticket->title;
            },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($data)
            {
                return $data->status->name;
            },
            ],
            'begin_at',
            'end_at',
//            'created_at',
//            'updated_at',
            [
                'attribute' => 'created_user',
                'value' => function($data)
            {
                return $data->createdUser->username;
            },
            ],
            [
                'attribute' => 'updated_user',
                'value' => function($data)
            {
                return $data->updatedUser->username;
            },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]);
    ?>

</div>
