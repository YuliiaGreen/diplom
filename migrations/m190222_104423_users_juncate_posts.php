<?php

use yii\db\Migration;

/**
 * Class m190222_104423_users_juncate_posts
 */
class m190222_104423_users_juncate_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//one to many/many to one
        $this->createIndex(
            'index-post_users-user_id',
            '{{%posts}}',
            'user_id');
        $this->addForeignKey(
            'fk-posts_users-user_id',
            '{{%posts}}',
            'user_id',
            '{{%users}}',
            'id'
//        ,
//        'CASCADE','CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-posts_users-user_id', '{{%posts}}');
        $this->dropIndex('index-post_users-user_id', '{{%posts}}');
        return true;

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_104423_users_juncate_posts cannot be reverted.\n";

        return false;
    }
    */
}
