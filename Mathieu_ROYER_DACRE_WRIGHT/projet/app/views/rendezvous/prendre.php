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
    <h1>Prendre un rendez-vous pour une soutenance</h1>

    <?= $message ?? '' ?>

    <form id="formProjet" method="post" action="">
        <div class="mb-3">
            <label for="projet" class="form-label">Sélectionnez un projet :</label>
            <select class="form-select" id="projet" name="projet" onchange="submitForm()" required>
                <option value="">-- Choisir un projet --</option>
                <?php foreach ($projets as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= ($projetSelectionne == $p['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
    <br>
    <?php if (!empty($projetSelectionne)): ?>
        <?php if (empty($creneaux)): ?>
            <div class="alert alert-warning">Aucun créneau disponible pour ce projet.</div>
        <?php else: ?>
            <form method="post" action="">
                <input type="hidden" name="projet" value="<?= htmlspecialchars($projetSelectionne) ?>" />
                <div class="mb-3">
                    <label for="creneau" class="form-label">Sélectionnez un créneau horaire :</label>
                    <select class="form-select" id="creneau" name="creneau" required>
                        <option value="">-- Choisir un créneau --</option>
                        <?php foreach ($creneaux as $c): ?>
                            <option value="<?= $c['id'] ?>">
                                <?= (new DateTime($c['creneau']))->format('d/m/Y H:i') ?>
                                - Examinateur : <?= htmlspecialchars($c['prenom'] . ' ' . $c['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Prendre rendez-vous</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    function submitForm() {
        document.getElementById('formProjet').submit();
    }
</script>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
