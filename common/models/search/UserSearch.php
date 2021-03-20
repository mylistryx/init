<?php

declare(strict_types=1);

namespace common\models\search;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends Model
{
    public ?int $id;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['id', 'integer'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = []): ActiveDataProvider
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);

        return $dataProvider;
    }
}