<?php
use yii\helpers\Url;
$this->title = 'Wąż';
?>
<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px;
            margin:0 auto; max-width:500px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <h2 class="text-center mb-4">🐍 Wąż</h2>

    <div class="text-center mb-3">
        <span class="badge bg-info fs-5">Wynik: <span id="score">0</span></span>
    </div>

    <div class="text-center">
        <canvas id="gameCanvas" width="400" height="400"
                style="border:3px solid #667eea; border-radius:10px; background:#f9f9f9;"></canvas>
    </div>

    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="startGame()">▶ Start / Restart</button>
        <p class="text-muted mt-2 small">Sterowanie: strzałki na klawiaturze</p>
    </div>
</div>

<script>
const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');
const box = 20, saveUrl = '<?= Url::to(['/game/save-result']) ?>';
let snake, food, dir, score, gameLoop;

function startGame() {
    snake = [{x:10,y:10}];
    dir = {x:1,y:0};
    score = 0;
    document.getElementById('score').textContent = 0;
    placeFood();
    clearInterval(gameLoop);
    gameLoop = setInterval(update, 150);
}

function placeFood() {
    food = {
        x: Math.floor(Math.random()*20),
        y: Math.floor(Math.random()*20)
    };
}

function update() {
    const head = {x: snake[0].x+dir.x, y: snake[0].y+dir.y};
    if (head.x<0||head.x>=20||head.y<0||head.y>=20||
        snake.some(s=>s.x===head.x&&s.y===head.y)) {
        clearInterval(gameLoop);
        ctx.fillStyle='rgba(0,0,0,0.5)';
        ctx.fillRect(0,0,400,400);
        ctx.fillStyle='white';
        ctx.font='30px Arial';
        ctx.textAlign='center';
        ctx.fillText('Game Over! Wynik: '+score, 200, 200);
        fetch(saveUrl, {
            method:'POST',
            headers:{'Content-Type':'application/json'},
            body:JSON.stringify({game:'snake', score:score})
        }).then(r=>r.json()).then(d=>console.log(d));
        return;
    }
    snake.unshift(head);
    if (head.x===food.x&&head.y===food.y) {
        score += 2;
        document.getElementById('score').textContent = score;
        placeFood();
    } else snake.pop();
    draw();
}

function draw() {
    ctx.clearRect(0,0,400,400);
    snake.forEach((s,i) => {
        ctx.fillStyle = i===0 ? '#667eea' : '#764ba2';
        ctx.fillRect(s.x*box, s.y*box, box-2, box-2);
        ctx.strokeStyle='white';
        ctx.strokeRect(s.x*box, s.y*box, box-2, box-2);
    });
    ctx.fillStyle='#ff6b6b';
    ctx.beginPath();
    ctx.arc(food.x*box+box/2, food.y*box+box/2, box/2-2, 0, Math.PI*2);
    ctx.fill();
}

document.addEventListener('keydown', e => {
    if (e.key==='ArrowUp'&&dir.y!==1) dir={x:0,y:-1};
    if (e.key==='ArrowDown'&&dir.y!==-1) dir={x:0,y:1};
    if (e.key==='ArrowLeft'&&dir.x!==1) dir={x:-1,y:0};
    if (e.key==='ArrowRight'&&dir.x!==-1) dir={x:1,y:0};
});

startGame();
</script>