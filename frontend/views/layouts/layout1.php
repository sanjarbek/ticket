<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-sm-4">
    <?= $content; ?>
</div>
<div class="col-sm-8">
    <iframe id="ticket-content"
            onload="iframeLoaded()"
            style="width: 100%; border: none;"
            src="http://helpdesk.test/index.php?r=ticket/create">
    </iframe>
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
