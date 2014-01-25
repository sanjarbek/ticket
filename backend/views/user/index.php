<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\UserQuery $searchModel
 */
$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Создать пользователя', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter' => false,
            ],
            'firstname',
            'secondname',
            'username',
//            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            [
                'attribute' => 'role',
                'filter' => common\models\User::getRoleOptions(),
                'value' => function($data)
            {
                return $data->getRoleText();
            },
            ],
            [
                'attribute' => 'status',
                'filter' => common\models\User::getStatusOptions(),
                'value' => function($data)
            {
                return $data->getStatusText();
            },
            ],
            // 'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
