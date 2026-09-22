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
    <h1 class="mb-4">Liste des projets pour lesquels vous avez proposé un créneau</h1>

    <?php if (empty($projets)): ?>
        <div class="alert alert-info">Aucun projet trouvé.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Label du projet</th>
                    <th>Responsable</th>
                    <th>Groupe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet): ?>
                    <tr>
                        <td><?= htmlspecialchars($projet['label']) ?></td>
                        <td><?= htmlspecialchars($projet['prenom'] . ' ' . $projet['nom']) ?></td>
                        <td><?= htmlspecialchars($projet['groupe']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
