<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\forms\UserSignupCompleteForm;
use common\models\forms\UserSignupRequestForm;
use common\models\forms\UserSignupRequestResendForm;
use common\widgets\Alert;
use domain\services\User\UserSignupService;
use Yii;
use yii\web\Controller;

final class SignupController extends Controller
{
    private UserSignupService $userSignupService;

    public function __construct($id, $module, UserSignupService $userSignupService, $config = [])
    {
        $this->userSignupService = $userSignupService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $model = new UserSignupRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->userSignupService->signupRequest($model);
                Alert::success(Yii::t('app', 'Signup success'));
                return $this->goBack(['/site/index']);
            } catch (\DomainException $exception) {
                Alert::error($exception->getMessage());
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionResend()
    {
        $model = new UserSignupRequestResendForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->userSignupService->signupRequestResend($model);
                Alert::success(Yii::t('app','Signup resend success'));
                return $this->goBack(['/site/index']);
            } catch (\DomainException $exception) {
                Alert::error($exception->getMessage());
            }
        }

        return $this->render('resend', ['model' => $model]);
    }

    public function actionComplete(string $token)
    {
        try {
            $model = new UserSignupCompleteForm($token);
            $this->userSignupService->signupComplete($model);
            Alert::success(Yii::t('app', 'Signup compleete success'));
        } catch (\DomainException $exception) {
            Alert::error($exception->getMessage());
        }

        return $this->goBack(['/site/index']);
    }
}