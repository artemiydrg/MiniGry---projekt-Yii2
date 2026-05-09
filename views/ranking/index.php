<?php
$this->title = 'Ranking';
?>

<div style="background:white; border-radius:15px; padding:30px;
            margin:20px 0; box-shadow:0 5px 20px rgba(0,0,0,0.1);">
    <h2 class="text-center mb-4">🏆 TOP 10 Graczy</h2>

    <table class="table table-hover">
        <thead>
            <tr>
                <th width="80">Miejsce</th>
                <th>Gracz</th>
                <th class="text-end">Punkty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topPlayers as $index => $player): ?>
                <tr <?= $player->id == Yii::$app->user->id ? 'class="table-primary"' : '' ?>>
                    <td>
                        <?php if ($index === 0): ?>
                            <span style="background:linear-gradient(135deg,#FFD700,#FFA500);
                                color:white; padding:5px 15px; border-radius:20px; font-weight:bold;">
                                🥇 #1
                            </span>
                        <?php elseif ($index === 1): ?>
                            <span style="background:linear-gradient(135deg,#C0C0C0,#808080);
                                color:white; padding:5px 15px; border-radius:20px; font-weight:bold;">
                                🥈 #2
                            </span>
                        <?php elseif ($index === 2): ?>
                            <span style="background:linear-gradient(135deg,#CD7F32,#8B4513);
                                color:white; padding:5px 15px; border-radius:20px; font-weight:bold;">
                                🥉 #3
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">#<?= $index + 1 ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($player->username) ?></strong>
                        <?php if ($player->id == Yii::$app->user->id): ?>
                            <span class="badge bg-info ms-2">To Ty!</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <h5 class="mb-0"><?= $player->score ?> pkt</h5>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h3 class="text-white text-center mb-4">🎮 Rankingi według gier</h3>

<div class="row">
    <?php foreach ($games as $game): ?>
        <div class="col-md-6 mb-4">
            <div style="background:white; border-radius:15px; padding:20px;
                        box-shadow:0 5px 20px rgba(0,0,0,0.1);">
                <h5 class="mb-3"><?= $gameNames[$game] ?></h5>
                <?php if (!empty($gameRankings[$game])): ?>
                    <table class="table table-sm">
                        <tbody>
                            <?php foreach ($gameRankings[$game] as $idx => $entry): ?>
                                <tr>
                                    <td width="40"><?= $idx + 1 ?>.</td>
                                    <td><?= htmlspecialchars($entry['username'] ?? '?') ?></td>
                                    <td class="text-end">
                                        <strong><?= $entry['best_score'] ?></strong>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted small">Brak wyników</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>