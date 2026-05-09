<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;

class GameController extends Controller
{
    // ДОДАЙ ЦЕ:
    public function beforeAction($action)
    {
        if ($action->id === 'save-result') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

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

    public function actionTictactoe()
    {
        return $this->render('tictactoe');
    }

    public function actionTarget()
    {
        return $this->render('target');
    }

    public function actionSnake()
    {
        return $this->render('snake');
    }

    public function actionClicker()
    {
        return $this->render('clicker');
    }

    public function actionMemory()
    {
        return $this->render('memory');
    }

    public function actionBreakout()
    {
        return $this->render('breakout');
    }

    public function actionSaveResult()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (!Yii::$app->request->isPost) {
            return ['success' => false, 'message' => 'Nieprawidłowa metoda'];
        }

        $data = json_decode(Yii::$app->request->rawBody, true);

        if (!$data || !isset($data['game']) || !isset($data['score'])) {
            return ['success' => false, 'message' => 'Nieprawidłowe dane'];
        }

        $userId = Yii::$app->user->id;

        if (!$userId) {
            return ['success' => false, 'message' => 'Użytkownik nie zalogowany'];
        }

        $game  = $data['game'];
        $score = (int)$data['score'];
        $time  = isset($data['time']) ? (int)$data['time'] : null;

        try {
            Yii::$app->db->createCommand()->insert('games_results', [
                'user_id' => $userId,
                'game'    => $game,
                'score'   => $score,
                'time'    => $time,
                'date'    => date('Y-m-d H:i:s'),
            ])->execute();

            Yii::$app->db->createCommand()->update(
                'users',
                ['score' => new \yii\db\Expression('score + ' . $score)],
                ['id' => $userId]
            )->execute();

            $newScore = User::findOne($userId)->score;

            return [
                'success'       => true,
                'message'       => 'Wynik zapisany',
                'newTotalScore' => $newScore,
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}