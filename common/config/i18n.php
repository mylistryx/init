<?php

use yii\i18n\PhpMessageSource;

return [
    'translations' => [
        'app*'   => [
            'class'          => PhpMessageSource::class,
            'basePath'       => '@common/messages',
            'sourceLanguage' => 'en',
        ],
        'model*' => [
            'class'          => PhpMessageSource::class,
            'basePath'       => '@common/messages',
            'sourceLanguage' => 'en',
        ],
        'form*'  => [
            'class'          => PhpMessageSource::class,
            'basePath'       => '@common/messages',
            'sourceLanguage' => 'en',
        ],
    ],
];