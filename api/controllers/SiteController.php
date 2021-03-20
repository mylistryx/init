<?php

declare(strict_types=1);

namespace api\controllers;

use common\models\forms\LoginForm;
use common\models\User;
use Yii;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;

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
     * @throws ForbiddenHttpException
     */
    public function actionLogin(): User
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            return $model->getUser();
        }

        throw new ForbiddenHttpException('Invalid credentials');
    }
}