<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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
                'brandLabel' => 'Панель администратора',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems[] = ['label' => 'Главная', 'url' => ['/site/index']];
            $menuItems[] = [
                'label' => 'Настройки',
                'items' => [
                    [
                        'label' => 'Вопросы',
                        'url' => ['/ticket'],
                    ],
                    [
                        'label' => 'Категории вопросов',
                        'url' => ['/category'],
                    ],
                    [
                        'label' => 'Статусы',
                        'url' => ['/status'],
                    ],
                    [
                        'label' => 'Комментарии',
                        'url' => ['/comment'],
                    ],
                ]
            ];
            if (Yii::$app->user->isGuest)
            {
                $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
            } else
            {
                $menuItems[] = ['label' => 'Выход (' . Yii::$app->user->identity->showName() . ')', 'url' => ['/site/logout']];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; ДОС КРЕДОБАНК <?= date('Y') ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
