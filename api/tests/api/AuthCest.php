<?php

namespace api\tests\api;

use api\tests\ApiTester;
use common\fixtures\UserFixture;
use common\models\User;

class AuthCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures(
            [
                'user' => UserFixture::class,
            ]
        );
    }

    public function userLoginFailed(ApiTester $I)
    {
        /** @var User $fixture */
        $I->sendPost(
            'site/login',
            [
                'email'    => 'sfriesen@jenkins.info',
                'password' => 'password_1',
            ]
        );
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
    }

    public function userLoginSuccess(ApiTester $I)
    {
        /** @var User $fixture */
        $I->sendPost(
            'site/login',
            [
                'email'    => 'sfriesen@jenkins.info',
                'password' => 'password_0',
            ]
        );
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}