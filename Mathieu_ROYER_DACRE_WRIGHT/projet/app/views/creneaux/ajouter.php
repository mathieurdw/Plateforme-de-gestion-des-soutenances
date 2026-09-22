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
    <h1 class="mb-4">Ajouter un créneau à un projet</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            Le créneau a été ajouté avec succès.
        </div>
    <?php endif; ?>

    <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="projet_id" class="form-label">Projet</label>
            <select class="form-select" name="projet_id" id="projet_id" required>
                <option value="" disabled <?= empty($_POST['projet_id']) ? 'selected' : '' ?>>-- Sélectionnez un projet --</option>
                <?php foreach ($projets as $projet): ?>
                    <option value="<?= $projet['id'] ?>" <?= (isset($_POST['projet_id']) && $_POST['projet_id'] == $projet['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($projet['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                Veuillez sélectionner un projet.
            </div>
        </div>

        <div class="mb-3">
            <label for="date_heure" class="form-label">Date et heure</label>
            <input type="datetime-local" class="form-control" id="date_heure" name="date_heure"
                   value="<?= htmlspecialchars($_POST['date_heure'] ?? '') ?>" required>
            <div class="invalid-feedback">
                Veuillez renseigner la date et l'heure.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
