<?php
foreach ($comments as $comment):
    if ($comment->createdUser->id == $comment->ticket->createdUser->id)
        $background_color = \yii::$app->params['messageOwnerColor'];
    else
        $background_color = \yii::$app->params['messageReplierColor'];
    ?>
    <div class="comment well well-sm"  style="background-color: <?= $background_color ?>" id="c<?php echo $comment->id; ?>">
        <p class="time pull-right">
            <?= date('d.m.Y H:i:s', strtotime($comment->created_at)) ?>
        </p>
        <div class="author">
            <strong><?= yii\helpers\Html::encode($comment->createdUser->showName()) ?></strong> написал
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <?php echo yii\helpers\HtmlPurifier::process($comment->content); ?>
        </div>

    </div> <!--comment--> 
    <?php
endforeach;
?>
