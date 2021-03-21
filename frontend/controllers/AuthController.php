<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\forms\User\LoginForm;
use common\widgets\Alert;
use common\services\UserAuthService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

final class AuthController extends Controller
{
    private UserAuthService $userAuthService;

    public function __construct($id, $module, UserAuthService $userAuthService, $config = [])
    {
        $this->userAuthService = $userAuthService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->userAuthService->login($model);
                Alert::success(Yii::t('app', 'Auth success'));
                return $this->goBack();
            } catch (\DomainException $exception) {
                Alert::error($exception->getMessage());
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return Response
     */
    public function actionLogout(): Response
    {
        $this->userAuthService->logout();
        return $this->goHome();
    }
}