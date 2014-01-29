<?php

use yii\helpers\Html;
use common\models\User;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 */
$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php
            echo $model->id . '. ';
            echo Html::encode($this->title);
            $user = User::find(\yii::$app->user->id);
            if ($model->status_id == \common\models\Ticket::STATUS_NEW && $user->role == User::ROLE_USER)
            {
                echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'pull-right']);
            }
            ?>
        </h3>
    </div>
    <div class="panel-body">
        <div>
            <p class="pull-left small"><strong>Создал: </strong><i><?= $model->createdUser->showName() ?></i></p>
        </div>
        <div class="clearfix"></div>
        <div>
            <p class="pull-left small"><strong>Дата создания: </strong><?= date('d.m.Y H:i:s', strtotime($model->created_at)) ?> </p>
        </div>
        <div class="clearfix"></div>
        <div>
            <p class="pull-left small"><strong>Статус: </strong><?= $model->getStatusText() ?></p>
            <?php if ($model->status_id != common\models\Ticket::STATUS_NEW): ?>
                <p class="pull-right small"><strong>Заявку принял: </strong><?= $model->currentLog->createdUser->showName(); ?></p>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div>
            <?php if ($model->status_id == common\models\Ticket::STATUS_NEW && $user->role == User::ROLE_TECHNICIAN): ?>
                <p class='pull-left small'>
                    <a class='btn btn-sm btn-primary' href="#"
                       onclick="javascript: $.ajax({
                                       'type': 'POST',
                                       'url': '<?= $this->context->createUrl('/ticket/stupdate', ['id' => $model->id]) ?>',
                                       'data': {
                                           'Ticket[status_id]': '<?= common\models\Ticket::STATUS_INPROGRESS ?>',
                                           '<?= \yii::$app->request->csrfVar ?>': '<?= \yii::$app->request->csrfToken ?>',
                                       }
                                   }).done(function(msg) {
                                       alert(msg);
                                       location.reload();
                                   });">
                        Принять
                    </a>
                </p>
                <?php
            endif;
            if ($model->status_id == common\models\Ticket::STATUS_INPROGRESS)
            {
                if ($user->role == User::ROLE_USER && $user->id == $model->created_user):
                    ?>
                    <p class='pull-left small'>
                        <a class='btn btn-sm btn-primary' href="#"
                           onclick="javascript: $.ajax({
                                               'type': 'POST',
                                               'url': '<?= $this->context->createUrl('/ticket/stupdate', ['id' => $model->id]) ?>',
                                               'data': {
                                                   'Ticket[status_id]': '<?= common\models\Ticket::STATUS_FINISHED ?>',
                                                   '<?= \yii::$app->request->csrfVar ?>': '<?= \yii::$app->request->csrfToken ?>',
                                               }
                                           }).done(function(msg) {
                                               alert(msg);
                                               location.reload();
                                           });">
                            Закончить
                        </a>
                    </p>
                <?php elseif ($user->role == User::ROLE_TECHNICIAN && $user->id == $model->currentLog->created_user):
                    ?>
                    <p class='pull-left small'>
                        <a class='btn btn-sm btn-primary' href="#"
                           onclick="javascript: $.ajax({
                                               'type': 'POST',
                                               'url': '<?= $this->context->createUrl('/ticket/stupdate', ['id' => $model->id]) ?>',
                                               'data': {
                                                   'Ticket[status_id]': '<?= common\models\Ticket::STATUS_NEW ?>',
                                                   '<?= \yii::$app->request->csrfVar ?>': '<?= \yii::$app->request->csrfToken ?>',
                                               }
                                           }).done(function(msg) {
                                               alert(msg);
                                               location.reload();
                                           });">
                            Отмена
                        </a>
                    </p>
                    <?php
                endif;
            }
            ?>
        </div>
        <div class="clearfix"></div>
        <hr />

        <p><strong>Вопрос:</strong></p>
        <p>
            <?php
            echo yii\helpers\HtmlPurifier::process($model->content);
            ?>
        </p>
        <hr />
        <div id="comments">
            <?php
            echo $this->render('_comments', array(
                'ticket' => $model,
                'comments' => $model->comments,
            ));
            ?>

            <?php // if (Yii::app()->user->hasFlash('commentSubmitted')):            ?>
            <!--        <div class="flash-success">
            <?php // echo Yii::app()->user->getFlash('commentSubmitted');             ?>
                    </div>-->

            <?php
            if ($model->status_id == \common\ models\Ticket::STATUS_INPROGRESS)
            {
                echo '<hr>';
                echo $this->render('/comment/_form', ['model' => $comment]);
            }
            ?>
        </div><!-- comments -->
    </div>
</div>
