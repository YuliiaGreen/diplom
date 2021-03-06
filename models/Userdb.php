<?php


namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

/**
 * Created by PhpStorm.
 * User: 1
 * Date: 22.02.2019
 * Time: 18:12
 * **
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $auth_key
 * @property string $pass_reset_token
 * @property Comments[] $comments
 * @property Posts[] $posts
 */
class Userdb extends ActiveRecord implements \yii\web\IdentityInterface
{

    const USER_STATUS_REGISTERED = 1;
    const USER_STATUS_CONFIRMED = 10;
    const USER_STATUS_MODERATOR = 11;
    const USER_STATUS_ADMIN = 100;


    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'auth_key'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'auth_key', 'pass_reset_token'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 95],
            [['username'], 'unique'],
            [['pass_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'auth_key' => 'Auth Key',
            'pass_reset_token' => 'Pass Reset Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        $user = static::findOne($id);
        if (!empty($user)) {
            return $user;
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // auth_key == AcessToken
        $user = static::findOne(['auth_key' => $token]);
        if (!empty($user)) {
            return $user;
        }
        return null;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findByPassword($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        if (password_verify($password . Yii::$app->params['SALT'], $this->password)) {
            return true;
        }
        return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->password = password_hash(($this->password . Yii::$app->params ['SALT']), PASSWORD_ARGON2I);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}