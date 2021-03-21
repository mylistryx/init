<?php

declare(strict_types=1);

namespace common\repositories\User;

use common\exceptions\Repository\NotFoundException;
use common\exceptions\Repository\ValidationException;
use common\models\User;

/**
 * Interface UserRepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     * @throws NotFoundException
     */
    public function findById(int $id): User;

    /**
     * @param string $email
     * @return User
     * @throws NotFoundException
     */
    public function findByEmail(string $email): User;

    /**
     * @param string $token
     * @return User
     * @throws NotFoundException
     */
    public function findByPasswordResetToken(string $token): User;

    /**
     * @param string $token
     * @return User
     * @throws NotFoundException
     */
    public function findByConfirmationToken(string $token): User;

    /**
     * @param string $token
     * @return User
     * @throws NotFoundException
     */
    public function findByAccessToken(string $token): User;

    /**
     * @param User $entity
     * @param bool $runValidation
     * @return User
     * @throws ValidationException
     */
    public function save(User $entity, bool $runValidation = true): User;
}