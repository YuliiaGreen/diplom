<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 22.02.2019
 * Time: 18:13
 */

namespace app\models;

use yii\base\Model;
use app\models\Userdb;
use Yii;

class SignUp extends Model
{
    public $username;
    public $password;
    public $confirmPassword;
    public $email;

    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'confirmPassword', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['username', 'match', 'pattern' => '@^[a-z]+$@i', 'message' => 'wtfnk?',],
            //required i match в одному рулі не використовуєм
            ['email', 'validateEmail'],
            ['password', 'validatePasswordAndPasswordConfirm']
            // password is validated by validatePassword()
        ];
    }

    public function validatePasswordAndPasswordConfirm($password, $param)
    {
        if ($this->password == $this->confirmPassword) {
//            echo 'good';
            return true;
        } else {
            $this->addError($password, 'Password does not match');
            return false;
        }
    }

    public function validateEmail($email, $params)
    {
        $email = Userdb::findByEmail($this->email);
        if (!empty($email)) {
            $this->addError('email', 'email already exist');
            return false;
        } elseif (filter_var($this->email, FILTER_VALIDATE_EMAIL)
            && preg_match('@^[a-z][a-z0-9\-_]+\@gmail\.com$@i',
                $this->email)) {
            return true;
        } else {
            $this->addError($email, 'Email does not match');
            return false;
        }
    }

    public function SignUp()
    {
        $status = $this->validate();
        $this->validate();
        $user = Userdb::findByUsername($this->username);
        if (!empty($user)) {
            $this->addError('username', 'user already exist');
            return false;
        } else if ($status === true
//        && (!empty(Userdb::findByEmail($this->email))) or
//        && (!empty(Userdb::findOne($this->email))) я цю валідаху зробила тут public function validateEmail($email,
        ) {
            $user = new Userdb();
            $user->setAttributes([
                'username' => $this->username,
//                'password' => password_hash($this->password. Yii::$app->params ['SALT'], PASSWORD_ARGON2I),
                'password' => $this->password,
                'email' => $this->email,
                'status' => Userdb::USER_STATUS_REGISTERED,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
                'auth_key' => 'wil be genrat wenfser want to1',//todo
                'pass_reset_token' => $this->generateToken()
            ], true);
            //safeOnly true - не ыгнорувати валыдацыю
            $user->save();
            return true;
        } else return false;
    }

    public function generateToken()
    {
//       return $token = md5(openssl_random_pseudo_bytes(64));
        return $token = md5(uniqid(rand(), true));
    }
}

