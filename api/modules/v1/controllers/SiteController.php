<?php

declare(strict_types=1);

namespace api\modules\v1\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\Serializer;

class SiteController extends ActiveController
{
    public $modelClass = User::class;

    public $serializer = [
        'class'              => Serializer::class,
        'collectionEnvelope' => 'userList',
    ];

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider(
            [
                'query' => User::find(),
            ]
        );
    }
}