<?php

use codemix\localeurls\UrlManager;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'language'            => 'en',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user'         => [
            'class'           => \yii\web\User::class,
            'identityClass'   => \common\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl'        => ['site/login'],
            'identityCookie'  => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'i18n'         => [
            'translations' => [
                'app*' => [
                    'class'          => PhpMessageSource::class,
                    'basePath'       => '@frontend/messages',
                    'sourceLanguage' => 'en',
                    'fileMap'        => [
                        'app'      => 'app.php',
                        'app.menu' => 'app.menu.php',
                    ],
                ],
                'model*' => [
                    'class'          => PhpMessageSource::class,
                    'basePath'       => '@frontend/messages',
                    'sourceLanguage' => 'en',
//                    'fileMap'        => [
//                        'app'      => 'app.php',
//                        'app.menu' => 'app.menu.php',
//                    ],
                ],
                'form*' => [
                    'class'          => PhpMessageSource::class,
                    'basePath'       => '@frontend/messages',
                    'sourceLanguage' => 'en',
//                    'fileMap'        => [
//                        'app'      => 'app.php',
//                        'app.menu' => 'app.menu.php',
//                    ],
                ],
            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'class'           => UrlManager::class,
            'languages'       => ['en', 'ru'],
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require 'urlRules.php',
        ],
    ],
    'params'              => $params,
];
