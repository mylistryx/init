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
     * UserPasswordService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(UserRepositoryInterface $userRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param PasswordResetRequestForm $passwordResetRequestForm
     */
    public function passwordResetRequest(PasswordResetRequestForm $passwordResetRequestForm): void
    {
        $entity = $this->userRepository->findByEmail($passwordResetRequestForm->email);
        $entity->passwordResetRequest();
        $this->userRepository->save($entity);
        $this->eventDispatcher->dispatch($entity->releaseEvents());
    }

    /**
     * @param PasswordResetForm $passwordResetForm
     */
    public function passwordResetForm(PasswordResetForm $passwordResetForm): void
    {
        $entity = $this->userRepository->findByPasswordResetToken($passwordResetForm->token);
        $entity->passwordReset($passwordResetForm->password);
        $this->userRepository->save($entity);
        $this->eventDispatcher->dispatch($entity->releaseEvents());
    }
}