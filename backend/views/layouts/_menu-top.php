<?php

/**
 * @var View $this
 */

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;

NavBar::begin(
    [
        'brandLabel' => Yii::$app->name,
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md', 'fixed-top'],
        ],
    ]
); ?>
<?= Nav::widget(
    [
        'options' => ['class' => ['navbar-nav', 'ml-auto']],
        'items'   => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            [
                'label'       => Yii::$app->user->isGuest ? '' : Yii::t(
                    'app',
                    'Logout ({email})',
                    [
                        'email' => Yii::$app->user->identity->email,
                    ]
                ),
                'visible'     => !Yii::$app->user->isGuest,
                'url'         => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
            ],
        ],
    ]
); ?>
<?php NavBar::end(); ?>