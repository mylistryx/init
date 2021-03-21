<?php

use yii\db\Migration;

/**
 * Class m210321_164510_blog_post_category
 */
class m210321_164510_blog_post_category extends Migration
{
    public string $table = '{{%blog_post_category}}';
    public string $tableUser = '{{%user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->table,
            [
                'id'         => $this->primaryKey(),
                'name'       => $this->string()->notNull(),
                'slug'       => $this->string()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'FK_BlogPostCategory_CreatedBy__User_Id',
            $this->table,
            'created_by',
            $this->tableUser,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_BlogPostCategory_UpdatedBy__User_Id',
            $this->table,
            'updated_by',
            $this->tableUser,
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_BlogPostCategory_UpdatedBy__User_Id', $this->table);
        $this->dropForeignKey('FK_BlogPostCategory_CreatedBy__User_Id', $this->table);
        $this->dropTable($this->table);
    }
}
