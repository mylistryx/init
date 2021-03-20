<?php

use yii\rest\UrlRule;

return [
    [
        'class'      => UrlRule::class,
        'controller' => ['site' => 'site'],
        'only'       => ['index', 'view'],
        'prefix'     => 'v1',
    ],
];