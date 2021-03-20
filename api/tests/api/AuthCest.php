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

    public function userLogin(ApiTester $I)
    {
        /** @var User $fixture */
        $I->sendPost(
            'site/login',
            [
                'username' => 'erau',
                'password' => 'password_0',
            ]
        );
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}