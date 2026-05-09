<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "games_results".
 *
 * @property int $id
 * @property int $user_id
 * @property string $game
 * @property int $score
 * @property int|null $time
 * @property string $date
 *
 * @property Users $user
 */
class Games_results extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'default', 'value' => null],
            [['user_id', 'game', 'score'], 'required'],
            [['user_id', 'score', 'time'], 'integer'],
            [['date'], 'safe'],
            [['game'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'game' => 'Game',
            'score' => 'Score',
            'time' => 'Time',
            'date' => 'Date',
        ];
    }

    public function getUser()
    {
    return $this->hasOne(\app\models\User::class, ['id' => 'user_id']);
    }

}
