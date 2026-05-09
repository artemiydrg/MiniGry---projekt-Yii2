<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Games_results;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->id);

        $stats = \Yii::$app->db->createCommand("
            SELECT game,
                COUNT(*) as plays,
                MAX(score) as best_score,
                AVG(score) as avg_score
            FROM games_results
            WHERE user_id = :uid
            GROUP BY game
        ")->bindValue(':uid', $user->id)->queryAll();

        $recent = \Yii::$app->db->createCommand("
            SELECT * FROM games_results
            WHERE user_id = :uid
            ORDER BY date DESC
            LIMIT 10
        ")->bindValue(':uid', $user->id)->queryAll();

        return $this->render('index', [
            'user'   => $user,
            'stats'  => $stats,
            'recent' => $recent,
        ]);
    }
}