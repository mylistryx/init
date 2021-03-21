<?php

declare(strict_types=1);

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
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

    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I): void
    {
        $I->amOnPage(['site/login']);
        $I->fillField('Email', 'sfriesen@jenkins.info');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->seeLink('Logout (sfriesen@jenkins.info)', 'site/logout');
    }
}
