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
    <h1 class="mb-4">Mes rendez-vous de soutenance</h1>

    <?php if (empty($rendezVous)): ?>
        <div class="alert alert-info">Aucun rendez-vous planifié.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Date et heure</th>
                    <th>Examinateur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rendezVous as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['projet_label']) ?></td>
                        <td><?= htmlspecialchars((new DateTime($rdv['date_heure']))->format('d/m/Y H:i')) ?></td>
                        <td><?= htmlspecialchars($rdv['examinateur_prenom'] . ' ' . $rdv['examinateur_nom']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
