<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\forms\VerifyEmailForm;
use frontend\tests\UnitTester;
use yii\base\InvalidArgumentException;

class VerifyEmailFormTest extends Unit
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

    public function testVerifyWrongToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            function () {
                new VerifyEmailForm('');
            }
        );

        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            function () {
                new VerifyEmailForm('notexistingtoken_1391882543');
            }
        );
    }

    public function testAlreadyActivatedToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            function () {
                new VerifyEmailForm('already_used_token_1548675330');
            }
        );
    }

    public function testVerifyCorrectToken(): void
    {
        $model = new VerifyEmailForm('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
        $user = $model->verifyEmail();
        expect($user)->toBeInstanceOf(User::class);

        expect($user->username)->stringToContainString('test.test');
        expect($user->email)->stringToContainString('test@mail.com');
        expect($user->status)->toEqual(User::STATUS_ACTIVE);
        expect($user->validatePassword('Test1234'))->toBeTrue();
    }
}
