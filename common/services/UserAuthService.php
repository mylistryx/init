<?php

declare(strict_types=1);

namespace common\services;

use common\models\forms\User\LoginForm;
use common\models\User;
use Yii;

final class UserAuthService
{
    /**
     * @param LoginForm $loginForm
     * @return User
     */
    public function login(LoginForm $loginForm): User
    {
        Yii::$app->user->login($loginForm->user);
        return $loginForm->user;
    }

    public function logout(): void
    {
        Yii::$app->user->logout();
    }
}