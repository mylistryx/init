<?php

declare(strict_types=1);

namespace common\models\forms;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 *
 * @property-read null|User $user
 */
class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // status is validated by validateStatus
            ['username', 'validateStatus'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username'   => Yii::t('form.login', 'Username'),
            'password'   => Yii::t('form.login', 'Password'),
            'rememberMe' => Yii::t('form.login', 'Remember me'),
        ];
    }

    public function validateStatus(string $attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user->isDeleted()) {
                $this->addError($attribute, Yii::t('app', 'This account was deleted.'));
            }
            if ($user->isInactive()) {
                $this->addError($attribute, Yii::t('app', 'This account is inactive. Confirm email first!'));
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword(string $attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['user.rememberMeTimeout'] : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        static $user;
        if ($user === null) {
            $user = User::findByUsername($this->username);
        }

        return $user;
    }
}
