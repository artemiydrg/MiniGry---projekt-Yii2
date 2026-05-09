<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $avatar
 * @property int|null $score
 * @property string $created_at
 *
 * @property GamesResults[] $gamesResults
 */
class Users extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar'], 'default', 'value' => 'default.png'],
            [['score'], 'default', 'value' => 0],
            [['username', 'password'], 'required'],
            [['score'], 'integer'],
            [['created_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 100],
            [['username'], 'unique'],
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
            'avatar' => 'Avatar',
            'score' => 'Score',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[GamesResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGamesResults()
    {
        return $this->hasMany(GamesResults::class, ['user_id' => 'id']);
    }

}
