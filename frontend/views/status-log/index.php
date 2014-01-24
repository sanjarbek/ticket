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
<div class="status-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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
