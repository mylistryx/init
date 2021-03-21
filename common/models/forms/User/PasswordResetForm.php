<?php

declare(strict_types=1);

namespace common\models\forms\User;

use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 *
 * @property-read null|User $user
 */
class PasswordResetForm extends Model
{
    public string $password = '';

    private string $token;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     */
    public function __construct(string $token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }

        $this->token = $token;

        if (!$this->user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * @return bool
     * @deprecated
     */
    public function resetPassword(): bool
    {
        $user = $this->user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        static $user = null;
        if ($user === null) {
            $user = User::findByPasswordResetToken($this->token);
        }

        return $user;
    }
}
