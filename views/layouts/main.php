<?php
use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?> - MiniGry</title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #667eea !important;
        }
        .nav-link.text-danger {
            color: #dc3545 !important;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
            🎮 MiniGry
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (!\Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                            🏠 Główna
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            🎮 Gry
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/tictactoe']) ?>">❌⭕ Kółko i Krzyżyk</a></li>
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/target']) ?>">🎯 Kliknij Cele</a></li>
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/snake']) ?>">🐍 Wąż</a></li>
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/clicker']) ?>">🖱️ Clicker</a></li>
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/memory']) ?>">🃏 Memory</a></li>
                            <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/game/breakout']) ?>">🧱 Breakout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/ranking/index']) ?>">
                            🏆 Ranking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/profile/index']) ?>">
                            👤 Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">
                            🚪 Wyloguj
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/login']) ?>">
                            🔐 Zaloguj się
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/register']) ?>">
                            📝 Zarejestruj się
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>