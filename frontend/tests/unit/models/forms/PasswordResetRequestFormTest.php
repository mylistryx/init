<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;

use Codeception\Test\Unit;
use frontend\tests\UnitTester;
use Yii;
use frontend\models\forms\PasswordResetRequestForm;
use common\fixtures\UserFixture as UserFixture;
use common\models\User;
use yii\mail\MessageInterface;

class PasswordResetRequestFormTest extends Unit
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

    public function testSendMessageWithWrongEmailAddress(): void
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect($model->sendEmail())->toBeEmpty();
    }

    public function testNotSendEmailsToInactiveUser(): void
    {
        $user = $this->tester->grabFixture('user', 'inactive-user');
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect($model->sendEmail())->toBeEmpty();
    }

    public function testSendEmailSuccessfully(): void
    {
        $userFixture = $this->tester->grabFixture('user', 1);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect($model->sendEmail())->notToBeEmpty();
        expect($user->password_reset_token)->notToBeEmpty();

        $emailMessage = $this->tester->grabLastSentEmail();
        expect($emailMessage)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
        expect($emailMessage->getTo())->arrayToHaveKey($model->email);
        expect($emailMessage->getFrom())->arrayToHaveKey(Yii::$app->params['supportEmail']);
    }
}
