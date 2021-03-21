<?php

declare(strict_types=1);

namespace common\services;

use common\dispatchers\EventDispatcherInterface;
use common\models\forms\User\SignupCompleteForm;
use common\models\forms\User\SignupRequestForm;
use common\models\forms\User\SignupRequestResendForm;
use common\models\User;
use common\repositories\User\UserRepositoryInterface;
use yii\base\Exception;

/**
 * Class UserSignupService
 */
final class UserSignupService
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    /**
     * UserSignupService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(UserRepositoryInterface $userRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param SignupRequestForm $form
     * @throws Exception
     */
    public function signupRequest(SignupRequestForm $form): void
    {
        $entity = User::create($form->email, $form->password);
        $this->userRepository->save($entity);
        $this->eventDispatcher->dispatch($entity->releaseEvents());
    }

    /**
     * @param SignupRequestResendForm $form
     */
    public function signupRequestResend(SignupRequestResendForm $form): void
    {
        $entity = $this->userRepository->findByEmail($form->email);
        $entity->singupRequestResend();
        $this->userRepository->save($entity);
        $this->eventDispatcher->dispatch($entity->releaseEvents());
    }

    /**
     * @param SignupCompleteForm $form
     */
    public function signupComplete(SignupCompleteForm $form): void
    {
        $entity = $form->user;
        $entity->signupComplete();
        $this->userRepository->save($entity);
        $this->eventDispatcher->dispatch($entity->releaseEvents());
    }
}