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
    <h1 class="mb-4">Ajouter une liste de créneaux à un projet</h1>

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
            Les créneaux ont été ajoutés avec succès.
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
            <label for="date_heure_debut" class="form-label">Date et heure de début</label>
            <input type="datetime-local" class="form-control" id="date_heure_debut" name="date_heure_debut"
                   value="<?= htmlspecialchars($_POST['date_heure_debut'] ?? '') ?>" required>
            <div class="invalid-feedback">
                Veuillez renseigner la date et l'heure de début.
            </div>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de créneaux (1 à 10)</label>
            <input type="number" class="form-control" id="nombre" name="nombre" min="1" max="10"
                   value="<?= htmlspecialchars($_POST['nombre'] ?? '1') ?>" required>
            <div class="invalid-feedback">
                Veuillez saisir un nombre entre 1 et 10.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
