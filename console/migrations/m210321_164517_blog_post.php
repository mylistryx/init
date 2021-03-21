<?php

use yii\db\Migration;

/**
 * Class m210321_164517_blog
 */
class m210321_164517_blog_post extends Migration
{
    public string $table = '{{%blog_post}}';
    public string $tableUser = '{{%user}}';
    public string $tableCategory = '{{%blog_post_category}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->table,
            [
                'id'                    => $this->primaryKey(),
                'blog_post_category_id' => $this->integer()->notNull(),
                'title'                 => $this->string()->notNull(),
                'announce'              => $this->text(),
                'content'               => $this->text(),
                'created_at'            => $this->integer()->notNull(),
                'updated_at'            => $this->integer()->notNull(),
                'created_by'            => $this->integer()->notNull(),
                'updated_by'            => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'FK_BlogPost_BlogPostCategoryId__BlogPostCategory_Id',
            $this->table,
            'blog_post_category_id',
            $this->tableCategory,
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_BlogPost_CreatedBy__User_Id',
            $this->table,
            'created_by',
            $this->tableUser,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_BlogPost_UpdatedBy__User_Id',
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
        $this->dropForeignKey('FK_BlogPost_UpdatedBy__User_Id', $this->table);
        $this->dropForeignKey('FK_BlogPost_CreatedBy__User_Id', $this->table);
        $this->dropForeignKey('FK_BlogPost_BlogPostCategoryId__BlogPostCategory_Id', $this->table);
        $this->dropTable($this->table);
    }
}
