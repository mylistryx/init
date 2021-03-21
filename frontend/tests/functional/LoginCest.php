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
            'LoginForm[email]'    => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('sfriesen@jenkins.info', 'wrong'));
        $I->seeValidationError('Incorrect email or password.');
    }

    public function checkInactiveAccount(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('test@mail.com', 'Test1234'));
        $I->seeValidationError('Incorrect email or password');
    }

    public function checkValidLogin(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('sfriesen@jenkins.info', 'password_0'));
        $I->seeLink('Logout (sfriesen@jenkins.info)', 'site/logout');
        $I->dontSeeLink('Login', 'site/login');
        $I->dontSeeLink('Signup', 'site/signup');
    }
}
