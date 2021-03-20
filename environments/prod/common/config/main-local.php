<?php

use yii\db\Connection;
use yii\swiftmailer\Mailer;

return [
    'components' => [
        'db'     => [
            'class'    => Connection::class,
            'dsn'      => 'mysql:host=127.0.0.1;dbname=yii2advanced',
            'username' => 'root',
            'password' => 'root',
            'charset'  => 'utf8mb4',
        ],
        'mailer' => [
            'class'    => Mailer::class,
            'viewPath' => '@common/mail',
        ],
    ],
];
