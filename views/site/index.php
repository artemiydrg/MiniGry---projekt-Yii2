<?php
$this->title = 'Główna';
use yii\helpers\Url;
?>

<div style="background:white; border-radius:15px; padding:30px; 
            margin:30px 0; box-shadow:0 5px 20px rgba(0,0,0,0.1);">
    <div class="text-center">
        <h1 class="display-4">👋 Witaj, <?= htmlspecialchars($user->username) ?>!</h1>
        <p class="lead">Twój wynik: <strong><?= $user->score ?></strong> punktów 🏆</p>
        <p class="text-muted">Wybierz grę i zacznij zdobywać punkty!</p>
    </div>
</div>

<h2 class="text-white text-center mb-4">🎮 Dostępne Gry</h2>

<div class="row g-4">
    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/tictactoe']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">❌⭕</div>
                <h3 class="card-title mt-3">Kółko i Krzyżyk</h3>
                <p class="card-text text-muted">Graj przeciwko komputerowi</p>
                <span class="badge bg-success">+10 punktów</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/target']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">🎯</div>
                <h3 class="card-title mt-3">Kliknij Cele</h3>
                <p class="card-text text-muted">Klikaj cele jak najszybciej!</p>
                <span class="badge bg-info">Punkty za celność</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/snake']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">🐍</div>
                <h3 class="card-title mt-3">Wąż</h3>
                <p class="card-text text-muted">Klasyczna gra Snake</p>
                <span class="badge bg-info">Punkty za wynik</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/clicker']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">🖱️</div>
                <h3 class="card-title mt-3">Clicker</h3>
                <p class="card-text text-muted">Klikaj jak najszybciej!</p>
                <span class="badge bg-warning">10 sekund</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/memory']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">🃏</div>
                <h3 class="card-title mt-3">Memory</h3>
                <p class="card-text text-muted">Znajdź pary kart!</p>
                <span class="badge bg-purple" style="background:#764ba2;">Punkty za pamięć</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100" style="border-radius:15px; cursor:pointer; transition:transform 0.3s;"
             onmouseover="this.style.transform='translateY(-10px)'"
             onmouseout="this.style.transform='translateY(0)'"
             onclick="location.href='<?= Url::to(['/game/breakout']) ?>'">
            <div class="card-body text-center p-4">
                <div style="font-size:4rem;">🧱</div>
                <h3 class="card-title mt-3">Breakout</h3>
                <p class="card-text text-muted">Rozbij wszystkie bloki!</p>
                <span class="badge bg-danger">Punkty za bloki</span>
            </div>
        </div>
    </div>
</div>