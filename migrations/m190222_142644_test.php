<?php

use yii\db\Migration;

/**
 * Class m190222_142644_test
 */
class m190222_142644_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//$this->insert('{{%users}}',
//    [
//        'username'=>'yulia',
//        'password'=>'pass',
//        'email'=>'emsil',
//        'status'=>10,
//        'created_at'=> date('y-m-d h:i:s'),
////        'updated_at'=> time();
//        'auth_key'=>'lalala',
//        'pass_reset_token'=>'prtoken'
//    ]);

        $data = file_get_contents(Yii::$app->basePath . '/users.txt');
        $rows = explode("\n", $data);
        $users = [];
        foreach ($rows as $row) {
            $users[] = explode(',', $row);
        }
        $this->batchInsert(
            '{{%users}}',
            ['username', 'password', 'email', 'status', 'created_at', 'updated_at', 'auth_key', 'pass_reset_token'],
            $users
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%users}}', '`id` in (1,2,3)');
        return true;
    }


    /**
     * {@inheritdoc}
     */


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_142644_test cannot be reverted.\n";

        return false;
    }
    */
}
