<?php

namespace common\components\Actions;

use Yii;
use yii\base\Action;
use yii\web\Response;

class LanguageAction extends Action
{
    /**
     * @param string $locale
     * @return Response
     */
    public function run($locale = 'ru'): Response
    {
//        if (in_array($locale, Yii::$app->params['availableLocales'])) {
            $_SESSION['language'] = $locale;
//        }

        return $this->controller->goBack(Yii::$app->request->referrer);
    }
}