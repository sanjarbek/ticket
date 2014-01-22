<?php
foreach ($comments as $comment):
    if ($comment->createdUser->id == $comment->ticket->createdUser->id)
        $background_color = '#abc192';
    else
        $background_color = '#192abc';
    ?>
    <div class="comment well well-sm"  style="background-color: <?= $background_color ?>" id="c<?php echo $comment->id; ?>">
        <p class="time pull-right">
            <?= date('d.m.Y H:i:s', strtotime($comment->created_at)) ?>
        </p>
        <div class="author">
            <strong><?= $comment->createdUser->username ?></strong> написал
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <?php echo yii\helpers\Html::encode($comment->content); ?>
        </div>

    </div> <!--comment--> 
    <?php
endforeach;
?>
