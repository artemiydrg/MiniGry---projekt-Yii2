<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;

class RankingController extends Controller
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
        $topPlayers = User::find()
            ->orderBy(['score' => SORT_DESC])
            ->limit(10)
            ->all();

        $games = ['tictactoe', 'target', 'snake', 'clicker', 'memory', 'breakout'];
        $gameNames = [
            'tictactoe' => 'Kółko i Krzyżyk',
            'target'    => 'Kliknij Cele',
            'snake'     => 'Wąż',
            'clicker'   => 'Clicker',
            'memory'    => 'Memory',
            'breakout'  => 'Breakout',
        ];

        $gameRankings = [];
        foreach ($games as $game) {
            $gameRankings[$game] = \Yii::$app->db->createCommand("
                SELECT u.username, MAX(gr.score) as best_score
                FROM games_results gr
                JOIN users u ON gr.user_id = u.id
                WHERE gr.game = :game
                GROUP BY u.id, u.username
                ORDER BY best_score DESC
                LIMIT 5
            ")->bindValue(':game', $game)->queryAll();
        }

        return $this->render('index', [
            'topPlayers'   => $topPlayers,
            'gameRankings' => $gameRankings,
            'gameNames'    => $gameNames,
            'games'        => $games,
        ]);
    }
}