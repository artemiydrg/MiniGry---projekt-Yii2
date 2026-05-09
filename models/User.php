<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['score'], 'integer'],
            [['created_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 100],
            [['username'], 'unique'],
        ];
    }

    // IdentityInterface методи
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function getGamesResults()
    {
        return $this->hasMany(GamesResults::class, ['user_id' => 'id']);
    }
}