<?php

declare(strict_types=1);

namespace common\models\forms\User;

use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Class UserSignupCompleteForm
 *
 * @property-read null|User $user
 */
class SignupCompleteForm extends Model
{
    /**
     * @var string
     */
    public string $token;

    /**
     * Creates a form model with given token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     */
    public function __construct($token = '', array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }

        $this->token = $token;

        if (!$this->user) {
            throw new InvalidArgumentException('Wrong verify email token.');
        }
        parent::__construct($config);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        static $user;
        if ($user === null) {
            $user = User::findByVerificationToken($this->token);
        }
        return $user;
    }
}
