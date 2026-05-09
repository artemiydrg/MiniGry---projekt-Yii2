<?php
use yii\helpers\Url;
$this->title = 'Kółko i Krzyżyk';
?>

<div class="text-center mt-3 mb-3">
    <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-light">← Powrót</a>
</div>

<div style="background:white; border-radius:15px; padding:30px; 
            margin:0 auto; max-width:500px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);">
    
    <h2 class="text-center mb-4">❌⭕ Kółko i Krzyżyk</h2>

    <div class="alert alert-info text-center" id="status">
        Twoja kolej! Grasz jako ❌
    </div>

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin:20px 0;">
        <?php for ($i = 0; $i < 9; $i++): ?>
            <div class="cell" data-cell="<?= $i ?>"
                 style="aspect-ratio:1; background:#f0f0f0; border:3px solid #667eea;
                        border-radius:10px; font-size:3rem; display:flex;
                        align-items:center; justify-content:center;
                        cursor:pointer; transition:all 0.3s;">
            </div>
        <?php endfor; ?>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" onclick="resetGame()">Nowa Gra</button>
    </div>
</div>

<script>
let board = ['','','','','','','','',''];
let gameActive = true;
const saveUrl = '<?= Url::to(['/game/save-result']) ?>';

const winPatterns = [
    [0,1,2],[3,4,5],[6,7,8],
    [0,3,6],[1,4,7],[2,5,8],
    [0,4,8],[2,4,6]
];

document.querySelectorAll('.cell').forEach(cell => {
    cell.addEventListener('click', handleClick);
    cell.addEventListener('mouseover', function() {
        if (!this.textContent && gameActive) this.style.background = '#e0e0ff';
    });
    cell.addEventListener('mouseout', function() {
        if (!this.textContent) this.style.background = '#f0f0f0';
    });
});

function handleClick(e) {
    const cell = e.target;
    const index = parseInt(cell.dataset.cell);
    if (board[index] || !gameActive) return;
    makeMove(index, 'X');
    if (gameActive) setTimeout(computerMove, 500);
}

function makeMove(index, player) {
    board[index] = player;
    const cell = document.querySelector(`[data-cell="${index}"]`);
    cell.textContent = player === 'X' ? '❌' : '⭕';
    cell.style.cursor = 'not-allowed';
    checkWinner();
}

function computerMove() {
    const empty = board.map((v,i) => v === '' ? i : null).filter(v => v !== null);
    if (!empty.length || !gameActive) return;
    makeMove(empty[Math.floor(Math.random() * empty.length)], 'O');
}

function checkWinner() {
    for (let [a,b,c] of winPatterns) {
        if (board[a] && board[a] === board[b] && board[a] === board[c]) {
            gameActive = false;
            const won = board[a] === 'X';
            const status = document.getElementById('status');
            status.className = `alert ${won ? 'alert-success' : 'alert-danger'} text-center`;
            status.textContent = won ? '🎉 Wygrałeś! +10 punktów' : '😔 Przegrałeś!';
            saveResult(won ? 10 : 0);
            return;
        }
    }
    if (!board.includes('')) {
        gameActive = false;
        document.getElementById('status').className = 'alert alert-warning text-center';
        document.getElementById('status').textContent = '🤝 Remis!';
        saveResult(5);
    }
}

function saveResult(score) {
    fetch(saveUrl, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({game: 'tictactoe', score: score})
    }).then(r => r.json()).then(d => console.log(d));
}

function resetGame() {
    board = ['','','','','','','','',''];
    gameActive = true;
    document.querySelectorAll('.cell').forEach(cell => {
        cell.textContent = '';
        cell.style.background = '#f0f0f0';
        cell.style.cursor = 'pointer';
    });
    document.getElementById('status').className = 'alert alert-info text-center';
    document.getElementById('status').textContent = 'Twoja kolej! Grasz jako ❌';
}
</script>