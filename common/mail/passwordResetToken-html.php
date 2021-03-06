<?php
/**
 * @var $this View
 * @var $user User
 */

use common\models\User;
use yii\helpers\Html;
use yii\web\View;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Follow the link below to reset your password:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
