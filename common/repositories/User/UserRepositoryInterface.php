<?php

namespace common\repositories\User;

use common\models\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User;

    /**
     * @param User $entity
     * @param bool $runValidation
     * @return User
     */
    public function save(User $entity, bool $runValidation = true): User;
}