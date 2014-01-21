<?php foreach ($comments as $comment): ?>
    <div class="comment well well-sm" id="c<?php echo $comment->id; ?>">
        <div class="author">
            <strong><?= $comment->createdUser->username ?></strong> написал

        </div>
        <div class="time">
            <?= date('d.m.Y H:i:s', strtotime($comment->created_at)) ?>
        </div>
        <div class="content">
            <?php echo yii\helpers\Html::encode($comment->content); ?>
        </div>

    </div> <!--comment--> 
    <?php
endforeach;
?>
