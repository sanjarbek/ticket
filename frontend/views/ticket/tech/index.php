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
<div class="row">
    <div class="col-sm-3">
        <div class=" panel panel-primary panel ticket-filtering">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= Html::encode('Фильтрация') ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $this->render('tech/_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-9">        
        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-pills pull-right">
                    <li <?php if ($searchModel->status_id == \common\models\Ticket::STATUS_NEW) echo 'class="active"' ?>>
                        <a href="<?=
                        $this->context->createUrl('/ticket/index', [
                            'TicketQuery[status_id]' => \common\models\Ticket::STATUS_NEW,
                            'TicketQuery[created_user]' => $searchModel->created_user,
                            'TicketQuery[category_id]' => $searchModel->category_id,
                            'TicketQuery[from_date]' => $searchModel->from_date,
                            'TicketQuery[to_date]' => $searchModel->to_date,
                        ])
                        ?>">
                            Новые
                        </a>
                    </li>
                    <li <?php if ($searchModel->status_id == \common\models\Ticket::STATUS_INPROGRESS) echo 'class="active"' ?>>
                        <a href="<?=
                        $this->context->createUrl('/ticket/index', [
                            'TicketQuery[status_id]' => \common\models\Ticket::STATUS_INPROGRESS,
                            'TicketQuery[created_user]' => $searchModel->created_user,
                            'TicketQuery[category_id]' => $searchModel->category_id,
                            'TicketQuery[from_date]' => $searchModel->from_date,
                            'TicketQuery[to_date]' => $searchModel->to_date])
                        ?>">
                            Принятые
                        </a>
                    </li>
                    <li <?php if ($searchModel->status_id == \common\models\Ticket::STATUS_FINISHED) echo 'class="active"' ?>>
                        <a href="<?=
                        $this->context->createUrl('/ticket/index', [
                            'TicketQuery[status_id]' => \common\models\Ticket::STATUS_FINISHED,
                            'TicketQuery[created_user]' => $searchModel->created_user,
                            'TicketQuery[category_id]' => $searchModel->category_id,
                            'TicketQuery[from_date]' => $searchModel->from_date,
                            'TicketQuery[to_date]' => $searchModel->to_date]
                        )
                        ?>">
                            Решенные
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'layout' => '{items}{pager}{summary}',
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered',
                ],
                'showHeader' => true,
                'pager' => [
                    'class' => 'yii\widgets\LinkPager',
                    'maxButtonCount' => 5,
                    'options' => [
                        'class' => 'pagination pagination-sm pull-right',
                        'style' => 'margin-right: 10px; margin-top: 0px; margin-bottom: 5px;',
                    ]
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'category_id',
                        'filter' => false,
                        'value' => function($data)
                    {
                        return $data->category->title;
                    },
                    ],
                    'title',
//                    [
//                        'attribute' => 'status_id',
//                        'format' => 'html',
//                        'value' => function($data)
//                    {
//                        $label = '';
//                        if ($data->status_id == common\models\Ticket::STATUS_NEW)
//                            $label = '<span class="label label-default">' . $data->getStatusText() . '</span>';
//                        if ($data->status_id == common\models\Ticket::STATUS_VIEWED)
//                            $label = '<span class="label label-warning">' . $data->getStatusText() . '</span>';
//                        if ($data->status_id == common\models\Ticket::STATUS_FINISHED)
//                            $label = '<span class="label label-success">' . $data->getStatusText() . '</span>';
//                        return $label;
//                    }
//                    ],
                    [
                        'attribute' => 'created_user',
                        'value' => function ($data)
                    {
                        return $data->createdUser->showName();
                    }
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($data)
                    {
                        return date('d.m.Y H:s:i', strtotime($data->created_at));
                    }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function($url, $model)
                        {
                            return Html::a('<span class="btn btn-info pull-right">Показать</span>', '#', [
                                    'title' => Yii::t('yii', 'View'),
                                    'onClick' => "javascript: $('#ticket-content').attr('src', '" . $url . "'); $('#myModal').modal();",
                            ]);
                        }
                        ],
                    ],
                ],
            ]);
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
