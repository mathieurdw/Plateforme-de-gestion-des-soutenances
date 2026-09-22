<?php
// Inclusions des fragments
require_once __DIR__ . '/../fragments/fragmentHeader.php';
?>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentMenu.php';
require_once __DIR__ . '/../fragments/fragmentJumbotron.php';
?>


<div class="container mt-5">
    <h1 class="mb-4">Liste complète de mes créneaux</h1>

    <?php if (empty($creneaux)): ?>
        <div class="alert alert-info">Aucun créneau proposé.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID Créneau</th>
                    <th>Date et Heure</th>
                    <th>Projet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($creneaux as $creneau): ?>
                    <tr>
                        <td><?= htmlspecialchars($creneau['id']) ?></td>
                        <td><?= htmlspecialchars($creneau['creneau']) ?></td>
                        <td><?= htmlspecialchars($creneau['projet_label']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
