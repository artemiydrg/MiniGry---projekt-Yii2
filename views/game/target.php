<?php
use yii\helpers\Url;
$this->title = 'Kliknij Cele';
?>
<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px;
            margin:0 auto; max-width:600px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <h2 class="text-center mb-4">🎯 Kliknij Cele</h2>

    <div class="text-center mb-3">
        <span class="badge bg-info fs-5">Wynik: <span id="score">0</span></span>
        <span class="badge bg-warning fs-5 ms-2">Czas: <span id="timer">30</span>s</span>
    </div>

    <div id="gameArea" style="position:relative; width:100%; height:400px;
                               background:#f0f0f0; border-radius:10px; overflow:hidden;">
        <div class="text-center" style="padding-top:180px;">
            <button class="btn btn-primary btn-lg" onclick="startGame()">▶ Start</button>
        </div>
    </div>
</div>

<script>
let score = 0, timer = 30, interval, gameRunning = false;
const saveUrl = '<?= Url::to(['/game/save-result']) ?>';

function startGame() {
    score = 0; timer = 30; gameRunning = true;
    document.getElementById('score').textContent = 0;
    document.getElementById('gameArea').innerHTML = '';
    interval = setInterval(() => {
        timer--;
        document.getElementById('timer').textContent = timer;
        if (timer <= 0) endGame();
        else spawnTarget();
    }, 1000);
    spawnTarget();
}

function spawnTarget() {
    const area = document.getElementById('gameArea');
    const target = document.createElement('div');
    const size = Math.random() * 40 + 30;
    target.style.cssText = `position:absolute; width:${size}px; height:${size}px;
        background:radial-gradient(circle, #ff6b6b, #ee5a24);
        border-radius:50%; cursor:pointer;
        left:${Math.random()*(area.offsetWidth-size)}px;
        top:${Math.random()*(area.offsetHeight-size)}px;
        transition:transform 0.1s;`;
    target.addEventListener('click', () => {
        score += Math.round(100/size*10);
        document.getElementById('score').textContent = score;
        target.remove();
        spawnTarget();
    });
    area.appendChild(target);
    setTimeout(() => target.remove(), 2000);
}

function endGame() {
    clearInterval(interval);
    gameRunning = false;
    document.getElementById('gameArea').innerHTML = `
        <div class="text-center" style="padding-top:150px;">
            <h3>Koniec! Wynik: ${score} pkt</h3>
            <button class="btn btn-primary mt-3" onclick="startGame()">Zagraj ponownie</button>
        </div>`;
    fetch(saveUrl, {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({game:'target', score:score})
    }).then(r=>r.json()).then(d=>console.log(d));
}
</script>