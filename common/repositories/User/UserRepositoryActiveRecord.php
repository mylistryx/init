<?php

namespace common\repositories\User;

use common\models\User;

final class UserRepositoryActiveRecord implements UserRepositoryInterface
{
    public function findById(int $id): User
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
    }

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function save(User $entity, bool $runValidation = true): User
    {
        if ($entity->save($runValidation)) {
            return $entity;
        }
    }
}