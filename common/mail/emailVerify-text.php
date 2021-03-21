<?php

/**
 * @var $this View
 * @var $user User
 */

use common\models\User;
use yii\web\View;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Follow the link below to verify your email:
<?= $verifyLink ?>
