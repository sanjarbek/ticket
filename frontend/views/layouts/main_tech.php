<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Служба технической поддержки',
                'brandUrl' => ['/ticket/index'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                [
                    'label' => 'Главная',
                    'url' => ['/ticket/index'],
//                    'linkOptions' => [
//                        'class' => 'glyphicon glyphicon-home',
//                    ],
                ],
            ];
            if (Yii::$app->user->isGuest)
            {
//                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
            } else
            {
                $menuItems[] = ['label' => 'Выход (' . common\models\User::find(\yii::$app->user->id)->showName() . ')', 'url' => ['/site/logout']];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?php
//                echo Breadcrumbs::widget([
//                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
                <!-- Modal -->
                <div class="modal fade" 
                     id="myModal" 
                     tabindex="-1" 
                     role="dialog" 
                     aria-labelledby="myModalLabel" 
                     aria-hidden="true" 
                     >
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 150%; left: -20%;">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <iframe id="ticket-content"
                                        onload="iframeLoaded()"
                                        style="width:100%; border: none;"
                                        src="">
                                </iframe>
                            </div>
                            <!--                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>-->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <?php
                $this->registerJs('
                    $("#myModal").on("hidden.bs.modal", function (e) {
                        $("#ticket-content").attr("src", "");
                        location.reload();
                    });

                    function iframeLoaded() {
                        var iFrameID = document.getElementById("ticket-content");
                        if(iFrameID) {
                              // here you can make the height, I delete it first, then I make it again
                              iFrameID.height = "";
                              iFrameID.height = 600 + "px";
                        }   
                    }', \yii\web\View::POS_END, 'my-options');
                ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; ДОС КРЕДОБАНК <?= date('Y') ?></p>
                <!--<p class="pull-right"><?php // echo Yii::powered()                                                                                                                    ?></p>-->
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
