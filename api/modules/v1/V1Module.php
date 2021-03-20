<?php

declare(strict_types=1);

namespace api\modules\v1;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class V1Module extends Module implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(require 'common/urlRules.php');
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class'       => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                QueryParamAuth::class,
            ],
        ];
        return $behaviors;
    }
}