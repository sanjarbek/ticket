<?php

$rootDir = dirname(dirname(__DIR__));

$params = array_merge(
    require($rootDir . '/common/config/params.php'), require($rootDir . '/common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'vendorPath' => $rootDir . '/vendor',
    'preload' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'language' => 'ru',
    'modules' => [],
    'extensions' => require($rootDir . '/vendor/yiisoft/extensions.php'),
    'components' => [
        'db' => $params['components.db'],
        'cache' => $params['components.cache'],
        'mail' => $params['components.mail'],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
