<?php
use yii\helpers\Url;
$this->title = 'Clicker';
?>
<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px;
            margin:0 auto; max-width:400px; text-align:center;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <h2 class="mb-4">🖱️ Clicker</h2>

    <div class="mb-3">
        <span class="badge bg-warning fs-5">Czas: <span id="timer">10</span>s</span>
        <span class="badge bg-info fs-5 ms-2">Kliknięcia: <span id="clicks">0</span></span>
    </div>

    <button id="clickBtn"
            style="width:200px; height:200px; border-radius:50%;
                   background:linear-gradient(135deg,#667eea,#764ba2);
                   border:none; color:white; font-size:1.5rem;
                   cursor:pointer; transition:transform 0.1s; box-shadow:0 5px 20px rgba(0,0,0,0.3);"
            onmousedown="this.style.transform='scale(0.95)'"
            onmouseup="this.style.transform='scale(1)'"
            onclick="handleClick()">
        🖱️ KLIKAJ!
    </button>

    <div class="mt-4">
        <button class="btn btn-primary" onclick="startGame()">▶ Start</button>
    </div>

    <div id="result" class="mt-3"></div>
</div>

<script>
let clicks=0, timer=10, interval, running=false;
const saveUrl='<?= Url::to(['/game/save-result']) ?>';

function startGame() {
    clicks=0; timer=10; running=true;
    document.getElementById('clicks').textContent=0;
    document.getElementById('timer').textContent=10;
    document.getElementById('result').innerHTML='';
    clearInterval(interval);
    interval=setInterval(()=>{
        timer--;
        document.getElementById('timer').textContent=timer;
        if(timer<=0){
            clearInterval(interval);
            running=false;
            document.getElementById('result').innerHTML=
                `<div class="alert alert-success">Wynik: ${clicks} kliknięć!</div>`;
            fetch(saveUrl,{
                method:'POST',
                headers:{'Content-Type':'application/json'},
                body:JSON.stringify({game:'clicker',score:clicks})
            }).then(r=>r.json()).then(d=>console.log(d));
        }
    },1000);
}

function handleClick() {
    if(!running) return;
    clicks++;
    document.getElementById('clicks').textContent=clicks;
}
</script>