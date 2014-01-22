<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-sm-4">
    <?= $content; ?>
</div>
<div class="col-sm-8">
    <?= 'Hello world' ?>
</div>
<?php $this->endContent(); ?>
