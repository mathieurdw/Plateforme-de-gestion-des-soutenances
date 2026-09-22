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
    <h1 class="mb-4">Planning d’un projet</h1>

    <form method="post" action="">
        <div class="mb-3">
            <label for="projet" class="form-label">Sélectionnez un projet</label>
            <select name="projet" id="projet" class="form-select" required>
                <option value="" disabled <?= empty($projetSelectionne) ? 'selected' : '' ?>>-- Choisir un projet --</option>
                <?php foreach ($projets as $projet): ?>
                    <option value="<?= $projet['id'] ?>" <?= ($projetSelectionne && $projet['id'] == $projetSelectionne['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($projet['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Afficher le planning</button>
    </form>

    <?php if ($rdvs !== null): ?>
        <h2 class="mt-5">Soutenances planifiées pour : <?= htmlspecialchars($projetSelectionne['label']) ?></h2>
        <?php if (empty($rdvs)): ?>
            <div class="alert alert-warning">Aucun rendez-vous planifié pour ce projet.</div>
        <?php else: ?>
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Étudiant</th>
                        <th>Créneau horaire</th>
                        <th>Examinateur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rdvs as $rdv): ?>
                        <tr>
                            <td><?= htmlspecialchars($rdv['etudiant_nom'] . ' ' . $rdv['etudiant_prenom']) ?></td>
                            <td><?= htmlspecialchars($rdv['creneau']) ?></td>
                            <td><?= htmlspecialchars($rdv['examinateur_nom'] . ' ' . $rdv['examinateur_prenom']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</div>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
