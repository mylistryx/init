<?php

namespace common\models;

use common\models\query\UserQuery;
use common\traits\IdentityTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $access_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @mixin TimestampBehavior
 */
class User extends ActiveRecord implements IdentityInterface
{
    use IdentityTrait;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * @return array
     */
    public static function getStatusList(): array
    {
        return [
            self::STATUS_DELETED  => Yii::t('app', 'Deleted'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE   => Yii::t('app', 'Active'),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'username'   => Yii::t('app', 'Username'),
            'email'      => Yii::t('app', 'Email'),
            'status'     => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields(): array
    {
        return ['id', 'username', 'email', 'status', 'created_at', 'updated_at'];
    }


    /**
     * @return UserQuery
     */
    public static function find(): UserQuery
    {
        return new UserQuery(get_called_class());
    }
}
