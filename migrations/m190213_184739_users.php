<?php

use yii\db\Migration;

/**
 * Class m190213_184739_users
 */
class m190213_184739_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        }
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull()->unique(),
            'password' => $this->string(95)->notNull(),
            'email' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
//REGISTERED_USER =1;
//CONFIRMED_USER =10;
//MODERATOR =11;
//ADMIN =100;
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'auth_key' => $this->string(32)->notNull(),
            'pass_reset_token' => $this->string(32)->unique()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        echo "m190213_184739_users cannot be reverted.\n";
        $this->dropTable('{{%users}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190213_184739_users cannot be reverted.\n";

        return false;
    }
    */
}
