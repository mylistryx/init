<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\forms\ResetPasswordForm;
use frontend\tests\UnitTester;
use yii\base\InvalidArgumentException;

class ResetPasswordFormTest extends Unit
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

    public function testResetWrongToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            function () {
                new ResetPasswordForm('');
            }
        );

        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            function () {
                new ResetPasswordForm('notexistingtoken_1391882543');
            }
        );
    }

    public function testResetCorrectToken()
    {
        $user = $this->tester->grabFixture('user', 1);
        $form = new ResetPasswordForm($user['password_reset_token']);
        $form->password = 'NewPassword';
        expect($form->resetPassword())->notToBeEmpty();
    }

}
