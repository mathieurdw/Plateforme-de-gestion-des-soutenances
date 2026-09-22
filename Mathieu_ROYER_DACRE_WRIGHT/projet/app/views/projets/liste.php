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
    <h1 class="mb-4">Liste des projets dont vous êtes responsable</h1>

    <?php if (empty($projets)): ?>
        <div class="alert alert-warning" role="alert">
            Aucun projet trouvé.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Label</th>
                    <th>Groupe (taille prévue)</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet): ?>
                    <tr>
                        <td><?= htmlspecialchars($projet['label']) ?></td>
                        <td><?= (int)$projet['groupe'] ?></td>
                        <td><?= htmlspecialchars($projet['responsable_nom'] . ' ' . $projet['responsable_prenom']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
