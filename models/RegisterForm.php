<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;

    public function rules()
    {
    return [
        [['username', 'password', 'confirm_password'], 'required',
            'message' => 'To pole jest wymagane'],
        [['username'], 'string', 'min' => 3, 'max' => 50,
            'tooShort' => 'Min. 3 znaki'],
        [['password'], 'string', 'min' => 6,
            'tooShort' => 'Min. 6 znaków'],
        ['confirm_password', 'compare', 'compareAttribute' => 'password',
            'message' => 'Hasła nie są identyczne'],
        ['username', 'unique', 'targetClass' => User::class,
            'message' => 'Użytkownik o tej nazwie już istnieje'],
    ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = password_hash($this->password, PASSWORD_DEFAULT);
            $user->score = 0;
            $user->avatar = 'default.png';
            return $user->save();
        }
        return false;
    }
}