<?php

use api\modules\v1\V1Module;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-api',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [
        'v1' => [
            'class' => V1Module::class,
        ],
    ],
    'components'          => [
        'request'    => [
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'response'   => [
            'format'     => Response::FORMAT_JSON,
            'charset'    => 'UTF-8',
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class'         => JsonResponseFormatter::class,
                    'prettyPrint'   => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user'       => [
            'class'           => \yii\web\User::class,
            'identityClass'   => \common\models\User::class,
            'enableAutoLogin' => false,
            'enableSession'   => false,
            'loginUrl'        => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require 'urlRules.php',
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params'              => $params,
];
