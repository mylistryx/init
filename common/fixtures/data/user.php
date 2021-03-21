<?php

use common\models\User;

return [
    1               => [
        'id'                   => 1,
        'email'                => 'sfriesen@jenkins.info',
        'auth_key'             => 'tUu1qHcde0diwUol3xeI-18MuHkkprQI',
        'status'               => User::STATUS_ACTIVE,
        // password_0
        'password_hash'        => '$2y$13$nJ1WDlBaGcbCdbNC5.5l4.sgy.OMEKCqtDQOdQ2OWpgiKRWYyzzne',
        'password_reset_token' => 'RkDdJw0f8HEedzLk7MM-ZKEFfYR7VbMr_' . time(),
        'access_token'         => 'AccessToken1',
        'created_at'           => '1392559490',
        'updated_at'           => '1392559490',
    ],
    'inactive-user' => [
        'auth_key'           => 'O87GkY3_UfmMHYkyezZ7QLfmkKNsllzT',
        //Test1234
        'password_hash'      => '$2y$13$d17z0w/wKC4LFwtzBcmx6up4jErQuandJqhzKGKczfWuiEhLBtQBK',
        'email'              => 'test@mail.com',
        'status'             => User::STATUS_INACTIVE,
        'access_token'       => 'AccessToken2',
        'created_at'         => '1548675330',
        'updated_at'         => '1548675330',
        'verification_token' => '4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330',
    ],
    3               => [
        'auth_key'             => 'iwTNae9t34OmnK6l4vT4IeaTk-YWI2Rv',
        'password_hash'        => '$2y$13$CXT0Rkle1EMJ/c1l5bylL.EylfmQ39O5JlHJVFpNn618OUS1HwaIi',
        'password_reset_token' => 't5GU9NwpuGYSfb7FEZMAxqtuz2PkEvv_' . time(),
        'access_token'         => 'AccessToken3',
        'created_at'           => '1391885313',
        'updated_at'           => '1391885313',
        'email'                => 'brady.renner@rutherford.com',
    ],
    4               => [
        'auth_key'             => 'EdKfXrx88weFMV0vIxuTMWKgfK2tS3Lp',
        'password_hash'        => '$2y$13$g5nv41Px7VBqhS3hVsVN2.MKfgT3jFdkXEsMC4rQJLfaMa7VaJqL2',
        'password_reset_token' => '4BSNyiZNAuxjs5Mty990c47sVrgllIi_' . time(),
        'access_token'         => 'AccessToken4',
        'created_at'           => '1391885313',
        'updated_at'           => '1391885313',
        'email'                => 'nicolas.dianna@hotmail.com',
        'status'               => User::STATUS_DELETED,
    ],
    6               => [
        'auth_key'           => '4XXdVqi3rDpa_a6JH6zqVreFxUPcUPvJ',
        //Test1234
        'password_hash'      => '$2y$13$d17z0w/wKC4LFwtzBcmx6up4jErQuandJqhzKGKczfWuiEhLBtQBK',
        'email'              => 'test2@mail.com',
        'status'             => '10',
        'access_token'       => 'AccessToken5',
        'created_at'         => '1548675330',
        'updated_at'         => '1548675330',
        'verification_token' => 'already_used_token_1548675330',
    ],
];