<?php
use yii\helpers\Url;
$this->title = 'Mój Profil';
$gameNames = [
    'tictactoe' => 'Kółko i Krzyżyk',
    'target'    => 'Kliknij Cele',
    'snake'     => 'Wąż',
    'clicker'   => 'Clicker',
    'memory'    => 'Memory',
    'breakout'  => 'Breakout',
];
?>

<div style="background:white; border-radius:15px; padding:30px;
            margin:20px 0; box-shadow:0 5px 20px rgba(0,0,0,0.1);">
    <div class="row">
        <div class="col-md-4 text-center">
            <i class="bi bi-person-circle" style="font-size:120px; color:#667eea;"></i>
            <h3 class="mt-3"><?= htmlspecialchars($user->username) ?></h3>
            <p class="text-muted">
                Członek od: <?= date('d.m.Y', strtotime($user->created_at)) ?>
            </p>
        </div>
        <div class="col-md-8">
            <h4 class="mb-4">📊 Twoje Statystyki</h4>
            <div class="alert alert-success">
                <h5>🏆 Łączny Wynik: <?= $user->score ?> punktów</h5>
            </div>
            <?php if ($stats): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Gra</th>
                            <th>Rozegrane</th>
                            <th>Najlepszy wynik</th>
                            <th>Średni wynik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stats as $stat): ?>
                            <tr>
                                <td><?= $gameNames[$stat['game']] ?? $stat['game'] ?></td>
                                <td><?= $stat['plays'] ?></td>
                                <td><strong><?= $stat['best_score'] ?></strong></td>
                                <td><?= round($stat['avg_score'], 1) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">Jeszcze nie zagrałeś w żadną grę!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($recent): ?>
<div style="background:white; border-radius:15px; padding:30px;
            margin:20px 0; box-shadow:0 5px 20px rgba(0,0,0,0.1);">
    <h4 class="mb-4">🎮 Ostatnie Gry</h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Gra</th>
                <th>Wynik</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recent as $game): ?>
              <tr>
                    <td><?= $gameNames[$game['game']] ?? $game['game'] ?></td>
                    <td>
                       <span class="badge bg-primary">
                         <?= $game['score'] ?> pkt
                       </span>
                    </td>
                    <td><?= date('d.m.Y H:i', strtotime($game['date'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>