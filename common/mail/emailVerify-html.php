<?php
/**
 * @var $this View
 * @var $user User
 */

use common\models\User;
use yii\bootstrap4\Html;
use yii\web\View;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Follow the link below to verify your email:</p>
    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
