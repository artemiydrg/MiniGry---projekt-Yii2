<?php
use yii\helpers\Url;
$this->title = 'Memory';
?>
<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px;
            margin:0 auto; max-width:500px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <h2 class="text-center mb-4">🃏 Memory</h2>

    <div class="text-center mb-3">
        <span class="badge bg-info fs-5">Pary: <span id="pairs">0</span>/8</span>
        <span class="badge bg-warning fs-5 ms-2">Ruchy: <span id="moves">0</span></span>
    </div>

    <div id="board" style="display:grid; grid-template-columns:repeat(4,1fr); gap:10px;"></div>

    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="initGame()">🔄 Nowa Gra</button>
    </div>
</div>

<script>
const emojis=['🐶','🐱','🐭','🐹','🐰','🦊','🐻','🐼'];
let cards=[], flipped=[], matched=0, moves=0, lock=false;
const saveUrl='<?= Url::to(['/game/save-result']) ?>';

function initGame() {
    const pairs=[...emojis,...emojis].sort(()=>Math.random()-0.5);
    matched=0; moves=0; flipped=[];
    document.getElementById('pairs').textContent=0;
    document.getElementById('moves').textContent=0;
    const board=document.getElementById('board');
    board.innerHTML='';
    pairs.forEach((emoji,i)=>{
        const card=document.createElement('div');
        card.style.cssText=`height:80px; background:#667eea; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:2rem; cursor:pointer; transition:all 0.3s; color:white;`;
        card.dataset.emoji=emoji;
        card.textContent='?';
        card.addEventListener('click',()=>flipCard(card));
        board.appendChild(card);
    });
}

function flipCard(card) {
    if(lock||flipped.includes(card)||card.dataset.matched) return;
    card.textContent=card.dataset.emoji;
    card.style.background='white';
    card.style.border='3px solid #667eea';
    flipped.push(card);
    if(flipped.length===2) {
        moves++;
        document.getElementById('moves').textContent=moves;
        lock=true;
        if(flipped[0].dataset.emoji===flipped[1].dataset.emoji) {
            flipped.forEach(c=>{
                c.dataset.matched=true;
                c.style.background='#90EE90';
            });
            matched++;
            document.getElementById('pairs').textContent=matched;
            flipped=[];
            lock=false;
            if(matched===8) {
                const score=Math.max(100-moves*5, 10);
                setTimeout(()=>{
                    alert(`🎉 Wygrałeś! Wynik: ${score} pkt`);
                    fetch(saveUrl,{
                        method:'POST',
                        headers:{'Content-Type':'application/json'},
                        body:JSON.stringify({game:'memory',score:score})
                    }).then(r=>r.json()).then(d=>console.log(d));
                },300);
            }
        } else {
            setTimeout(()=>{
                flipped.forEach(c=>{
                    c.textContent='?';
                    c.style.background='#667eea';
                    c.style.border='none';
                    c.style.color='white';
                });
                flipped=[];
                lock=false;
            },1000);
        }
    }
}

initGame();
</script>