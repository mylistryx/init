<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\forms\SignupForm;
use frontend\tests\UnitTester;
use Yii;
use yii\mail\MessageInterface;

class SignupFormTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;


    public function _before(): void
    {
        $this->tester->haveFixtures(
            [
                'user' => UserFixture::class,
            ]
        );
    }

    public function testCorrectSignup(): void
    {
        $model = new SignupForm(
            [
                'email'    => 'some_email@example.com',
                'password' => 'some_password',
            ]
        );

        $user = $model->signup();
        expect($user)->toBeTrue();

        /** @var User $user */
        $user = $this->tester->grabRecord(
            User::class,
            [
                'email'    => 'some_email@example.com',
                'status'   => User::STATUS_INACTIVE,
            ]
        );

        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        expect($mail)->toBeInstanceOf(MessageInterface::class);
        expect($mail->getTo())->arrayToHaveKey('some_email@example.com');
        expect($mail->getFrom())->arrayToHaveKey(Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->stringToContainString('Account registration at ' . Yii::$app->name);
        expect($mail->toString())->stringToContainString($user->verification_token);
    }

    public function testNotCorrectSignup(): void
    {
        $model = new SignupForm(
            [
                'email'    => 'nicolas.dianna@hotmail.com',
                'password' => 'some_password',
            ]
        );

        expect($model->signup())->toBeFalse();
        expect($model->getErrors())->arrayToHaveKey('email');

        expect($model->getFirstError('email'))
            ->stringToContainString('This email address has already been taken.');
    }
}
