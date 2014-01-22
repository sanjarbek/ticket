<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-sm-4">
    <?= $content; ?>
</div>
<div class="col-sm-8">
    <div class="row">
        <iframe id="ticket-content"
                onload="iframeLoaded()"
                class="well well-sm col-sm-8"
                style="width: 100%;"
                src="http://helpdesk.test/index.php?r=ticket/view&id=2">
        </iframe>   
    </div>
</div>
<?php
$this->registerJs('
  function iframeLoaded() {
      var iFrameID = document.getElementById("ticket-content");
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + 50 + "px";
      }   
  }', \yii\web\View::POS_END, 'my-options');
$this->endContent();
?>
