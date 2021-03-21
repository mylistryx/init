<?php

declare(strict_types=1);

namespace common\models\forms\User;

use Yii;
use common\models\User;
use yii\base\Model;

class SignupRequestResendForm extends Model
{
    /**
     * @var string
     */
    public string $email = '';


    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => User::class,
                'filter'      => ['status' => User::STATUS_INACTIVE],
                'message'     => 'There is no user with this email address.',
            ],
        ];
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail(): bool
    {
        $user = User::findOne(
            [
                'email'  => $this->email,
                'status' => User::STATUS_INACTIVE,
            ]
        );

        if ($user === null) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
