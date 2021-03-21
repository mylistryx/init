<?php

use yii\db\Migration;

/**
 * Class m210321_164527_blog_comment
 */
class m210321_164527_blog_post_comment extends Migration
{
    public string $table = '{{%blog_post_comment}}';
    public string $tablePost = '{{%blog_post}}';
    public string $tableUser = '{{%user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->table,
            [
                'id'           => $this->primaryKey(),
                'parent_id'    => $this->integer()->null(),
                'blog_post_id' => $this->integer()->notNull(),
                'content'      => $this->text(),
                'created_at'   => $this->integer()->notNull(),
                'updated_at'   => $this->integer()->notNull(),
                'created_by'   => $this->integer()->notNull(),
                'updated_by'   => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'FK_BlogPostComment_ParentId__BlogPostComment_Id',
            $this->table,
            'parent_id',
            $this->table,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_BlogPostComment_BlogPostId__BlogPost_Id',
            $this->table,
            'blog_post_id',
            $this->tablePost,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_BlogPostComment_CreatedBy__User_Id',
            $this->table,
            'created_by',
            $this->tableUser,
            'id',
            'CASCADE',
            'CASCADE'

        );

        $this->addForeignKey(
            'FK_BlogPostComment_UpdatedBy__User_Id',
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
        $this->dropForeignKey('FK_BlogPostComment_UpdatedBy__User_Id', $this->table);
        $this->dropForeignKey('FK_BlogPostComment_CreatedBy__User_Id', $this->table);
        $this->dropForeignKey('FK_BlogPostComment_BlogPostId__BlogPost_Id', $this->table);
        $this->dropForeignKey('FK_BlogPostComment_ParentId__BlogPostComment_Id', $this->table);
        $this->dropTable($this->table);
    }
}
