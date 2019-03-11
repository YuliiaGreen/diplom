<?php

use yii\db\Migration;

/**
 * Class m190222_105059_comments_juncate_users_and_posts
 */
class m190222_105059_comments_juncate_users_and_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'index-comments_users-user_id',
            '{{%comments}}',
            'user_id');
        $this->addForeignKey(
            'fk-comments_users-user_id',
            '{{%comments}}',
            'user_id',
            '{{%users}}',
            'id');
        $this->createIndex(
            'index-comments_posts-post_id',
            '{{%comments}}',
            'post_id');
        $this->addForeignKey(
            'fk-comments_posts-post_id',
            '{{%comments}}',
            'post_id',
            '{{%posts}}',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        echo "m190222_105059_comments_juncate_users_and_posts cannot be reverted.\n";
        $this->dropForeignKey('fk-comments_users-user_id', '{{%comments}}');
        $this->dropForeignKey('fk-comments_posts-post_id', '{{%comments}}');
        $this->dropIndex('index-comments_users-user_id', '{{%comments}}');
        $this->dropIndex('index-comments_posts-post_id', '{{%comments}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_105059_comments_juncate_users_and_posts cannot be reverted.\n";

        return false;
    }
    */
}
