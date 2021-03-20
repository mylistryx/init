<?php
/**
 * @var View $this
 */

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;

?>
<?php NavBar::begin(
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
            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            [
                'label' => Yii::t('app', 'Language'),
                'items' => array_map(
                    function ($code) {
                        return [
                            'label'  => Yii::$app->params['availableLocales'][$code],
                            'url'    => ['/site/set-locale', 'locale' => $code],
                            'active' => Yii::$app->language === $code,
                        ];
                    },
                    array_keys(Yii::$app->params['availableLocales'])
                ),
            ],
            ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup'], 'visible' => Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
            [
                'label'       => Yii::$app->user->isGuest ? '' : Yii::t(
                    'app',
                    'Logout ({username})',
                    [
                        'username' => Yii::$app->user->identity->username,
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