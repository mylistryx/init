<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        $this->createTable(
            '{{%user}}',
            [
                'id'                   => $this->primaryKey(),
                'email'                => $this->string()->notNull()->unique(),
                'auth_key'             => $this->string(32)->notNull(),
                'password_hash'        => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'verification_token'   => $this->string()->null(),
                'access_token'         => $this->string()->notNull()->unique(),
                'status'               => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at'           => $this->integer()->notNull(),
                'updated_at'           => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
