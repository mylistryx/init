<?php

declare(strict_types=1);

namespace common\services;

use common\dispatchers\EventDispatcherInterface;
use common\models\forms\User\PasswordResetForm;
use common\models\forms\User\PasswordResetRequestForm;
use common\repositories\User\UserRepositoryInterface;

final class UserPasswordService
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @param PasswordResetRequestForm $passwordResetRequestForm
     */
    public function passwordResetRequest(PasswordResetRequestForm $passwordResetRequestForm): void
    {
    }

    /**
     * @param PasswordResetForm $passwordResetForm
     */
    public function passwordResetForm(PasswordResetForm $passwordResetForm): void
    {
    }
}