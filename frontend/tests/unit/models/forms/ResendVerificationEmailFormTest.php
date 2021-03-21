<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;


use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\forms\SignupRequestResend;
use frontend\tests\UnitTester;
use Yii;
use yii\mail\MessageInterface;

class ResendVerificationEmailFormTest extends Unit
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

    public function testWrongEmailAddress(): void
    {
        $model = new SignupRequestResend();
        $model->attributes = [
            'email' => 'aaa@bbb.cc',
        ];

        expect($model->validate())->toBeFalse();
        expect($model->hasErrors())->toBeTrue();
        expect($model->getFirstError('email'))->stringToContainString('There is no user with this email address.');
    }

    public function testEmptyEmailAddress(): void
    {
        $model = new SignupRequestResend();
        $model->attributes = [
            'email' => '',
        ];

        expect($model->validate())->toBeFalse();
        expect($model->hasErrors())->toBeTrue();
        expect($model->getFirstError('email'))->stringToContainString('Email cannot be blank.');
    }

    public function testResendToActiveUser(): void
    {
        $model = new SignupRequestResend();
        $model->attributes = [
            'email' => 'test2@mail.com',
        ];

        expect($model->validate())->toBeFalse();
        expect($model->hasErrors())->toBeTrue();
        expect($model->getFirstError('email'))->stringToContainString('There is no user with this email address.');
    }

    public function testSuccessfullyResend(): void
    {
        $model = new SignupRequestResend();
        $model->attributes = [
            'email' => 'test@mail.com',
        ];

        expect($model->validate())->toBeTrue();
        expect($model->hasErrors())->toBeFalse();

        expect($model->sendEmail())->toBeTrue();
        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        expect($mail)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
        expect($mail->getTo())->arrayToHaveKey('test@mail.com');
        expect($mail->getFrom())->arrayToHaveKey(Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->stringToContainString('Account registration at ' . Yii::$app->name);
        expect($mail->toString())->stringToContainString('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
    }
}
