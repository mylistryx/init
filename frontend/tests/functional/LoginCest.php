<?php

declare(strict_types=1);

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @return array
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @see \Codeception\Module\Yii2::_before()
     */
    public function _fixtures(): array
    {
        return [
            'user' => UserFixture::class,
        ];
    }

    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password): array
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkInactiveAccount(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('test.test', 'Test1234'));
        $I->seeValidationError('Incorrect username or password');
    }

    public function checkValidLogin(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->seeLink('Logout (erau)', 'site/logout');
        $I->dontSeeLink('Login', 'site/login');
        $I->dontSeeLink('Signup', 'site/signup');
    }
}
