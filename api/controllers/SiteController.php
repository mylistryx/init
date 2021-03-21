<?php

declare(strict_types=1);

namespace api\controllers;

use common\models\forms\UserLoginForm;
use common\models\User;
use Yii;
use yii\rest\Controller;
use yii\web\UnauthorizedHttpException;

class SiteController extends Controller
{
    public function actionIndex(): array
    {
        return [
            'status' => 'OK',
            'code'   => 200,
        ];
    }

    /**
     * @return User
     * @throws UnauthorizedHttpException
     */
    public function actionLogin(): User
    {
        $model = new UserLoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            return $model->getUser();
        }

        throw new UnauthorizedHttpException('Invalid username or password');
    }
}