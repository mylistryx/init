<?php
/**
 * @var $this View
 * @var $user User
 */

use \common\models\User;
use yii\web\View;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
