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
    <h1 class="mb-4">Liste de mes créneaux pour un projet particulier</h1>

    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="projet_id" class="form-label">Sélectionnez un projet :</label>
            <select name="projet_id" id="projet_id" class="form-select" required>
                <option value="" disabled <?= $selectedProjetId === null ? 'selected' : '' ?>>-- Choisissez un projet --</option>
                <?php foreach ($projets as $projet): ?>
                    <option value="<?= $projet['id'] ?>" <?= ($selectedProjetId == $projet['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($projet['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Afficher les créneaux</button>
    </form>

    <?php if ($selectedProjetId !== null): ?>
        <?php if (empty($creneaux)): ?>
            <div class="alert alert-info">Aucun créneau proposé pour ce projet.</div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Créneau</th>
                        <th>Date et Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($creneaux as $creneau): ?>
                        <tr>
                            <td><?= htmlspecialchars($creneau['id']) ?></td>
                            <td><?= htmlspecialchars($creneau['creneau']) ?></td>
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
