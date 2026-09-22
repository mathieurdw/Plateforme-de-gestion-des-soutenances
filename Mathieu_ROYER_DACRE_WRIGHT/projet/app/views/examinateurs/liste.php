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
    <h1 class="mb-4">Liste des examinateurs</h1>

    <?php if (empty($examinateurs)): ?>
        <div class="alert alert-warning">Aucun examinateur trouvé.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($examinateurs as $examinateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($examinateur['nom']) ?></td>
                        <td><?= htmlspecialchars($examinateur['prenom']) ?></td>
                        <td><?= htmlspecialchars($examinateur['login']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
