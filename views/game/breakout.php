<?php
use yii\helpers\Url;
$this->title = 'Breakout';
?>
<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px;
            margin:0 auto; max-width:500px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <h2 class="text-center mb-4">🧱 Breakout</h2>

    <div class="text-center mb-3">
        <span class="badge bg-danger fs-5">Wynik: <span id="score">0</span></span>
        <span class="badge bg-info fs-5 ms-2">Życia: <span id="lives">3</span></span>
    </div>

    <div class="text-center">
        <canvas id="gameCanvas" width="440" height="400"
                style="border:3px solid #667eea; border-radius:10px; background:#f9f9f9;"></canvas>
    </div>

    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="startGame()">▶ Start / Restart</button>
        <p class="text-muted small mt-2">Sterowanie: mysz lub strzałki</p>
    </div>
</div>

<script>
const canvas=document.getElementById('gameCanvas');
const ctx=canvas.getContext('2d');
const saveUrl='<?= Url::to(['/game/save-result']) ?>';
let paddle,ball,bricks,score,lives,gameLoop,running=false;

function startGame() {
    paddle={x:170,y:370,w:100,h:12};
    ball={x:220,y:340,dx:3,dy:-3,r:8};
    score=0; lives=3;
    document.getElementById('score').textContent=0;
    document.getElementById('lives').textContent=3;
    bricks=[];
    for(let r=0;r<4;r++)
        for(let c=0;c<8;c++)
            bricks.push({x:c*52+10,y:r*30+30,w:46,h:22,alive:true,
                color:['#ff6b6b','#ffd93d','#6bcb77','#4d96ff'][r]});
    running=true;
    clearInterval(gameLoop);
    gameLoop=setInterval(update,16);
}

function update() {
    ball.x+=ball.dx; ball.y+=ball.dy;
    if(ball.x<ball.r||ball.x>440-ball.r) ball.dx*=-1;
    if(ball.y<ball.r) ball.dy*=-1;
    if(ball.y>440){
        lives--;
        document.getElementById('lives').textContent=lives;
        if(lives<=0){
            clearInterval(gameLoop); running=false;
            fetch(saveUrl,{method:'POST',headers:{'Content-Type':'application/json'},
                body:JSON.stringify({game:'breakout',score:score})}).then(r=>r.json());
        } else { ball={x:220,y:340,dx:3,dy:-3,r:8}; }
    }
    if(ball.y+ball.r>paddle.y&&ball.x>paddle.x&&ball.x<paddle.x+paddle.w) ball.dy*=-1;
    bricks.forEach(b=>{
        if(!b.alive) return;
        if(ball.x>b.x&&ball.x<b.x+b.w&&ball.y>b.y&&ball.y<b.y+b.h){
            b.alive=false; ball.dy*=-1;
            score+=10;
            document.getElementById('score').textContent=score;
        }
    });
    draw();
}

function draw() {
    ctx.clearRect(0,0,440,400);
    ctx.fillStyle='#667eea';
    ctx.beginPath();
    ctx.roundRect(paddle.x,paddle.y,paddle.w,paddle.h,6);
    ctx.fill();
    ctx.fillStyle='#764ba2';
    ctx.beginPath();
    ctx.arc(ball.x,ball.y,ball.r,0,Math.PI*2);
    ctx.fill();
    bricks.forEach(b=>{
        if(!b.alive) return;
        ctx.fillStyle=b.color;
        ctx.beginPath();
        ctx.roundRect(b.x,b.y,b.w,b.h,4);
        ctx.fill();
    });
}

canvas.addEventListener('mousemove',e=>{
    const rect=canvas.getBoundingClientRect();
    paddle.x=Math.min(Math.max(e.clientX-rect.left-paddle.w/2,0),440-paddle.w);
});
document.addEventListener('keydown',e=>{
    if(e.key==='ArrowLeft') paddle.x=Math.max(paddle.x-20,0);
    if(e.key==='ArrowRight') paddle.x=Math.min(paddle.x+20,440-paddle.w);
});
</script>