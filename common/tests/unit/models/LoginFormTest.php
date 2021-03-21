<?php

declare(strict_types=1);

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\tests\UnitTester;
use Yii;
use common\models\forms\LoginForm;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;


    /**
     * @return array
     */
    public function _fixtures(): array
    {
        return [
            'user' => UserFixture::class,
        ];
    }

    public function testLoginNoUser(): void
    {
        $model = new LoginForm(
            [
                'username' => 'not_existing_username',
                'password' => 'not_existing_password',
            ]
        );

        expect($model->login())->toBeFalse('model should not login user');
        expect(Yii::$app->user->isGuest)->toBeTrue('user should not be logged in');
    }

    public function testLoginWrongPassword(): void
    {
        $model = new LoginForm(
            [
                'username' => 'bayer.hudson',
                'password' => 'wrong_password',
            ]
        );

        expect($model->login())->toBeFalse('model should not login user');
        expect($model->errors)->arrayToHaveKey('password', 'error message should be set');
        expect(Yii::$app->user->isGuest)->toBeTrue('user should not be logged in');
    }


    public function testLoginCorrect(): void
    {
        $model = new LoginForm(
            [
                'username'   => 'erau',
                'password'   => 'password_0',
                'rememberMe' => true,
            ]
        );

        expect($model->login())->toBeTrue('model should login user');
        expect($model->errors)->arrayNotToHaveKey('password', 'error message should not be set');
        expect(Yii::$app->user->isGuest)->toBeFalse('user should be logged in');
    }
}
