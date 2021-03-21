<?php

namespace common\repositories\User;

use common\models\User;

final class UserRepositoryMemory implements UserRepositoryInterface
{
    public function findById(int $id): User
    {
        // TODO: Implement findById() method.
    }

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function save(User $entity, bool $runValidation = true): User
    {
        // TODO: Implement save() method.
    }
}