<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */
$this->title = $model->showName();
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a('Редактировать профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
//            'data-method' => 'post',
//        ]);
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'firstname',
            'secondname',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            [
                'name' => 'role',
                'value' => $model->getRoleText(),
            ],
            [
                'name' => 'status',
                'value' => $model->getStatusText(),
            ],
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]);
    ?>

</div>
