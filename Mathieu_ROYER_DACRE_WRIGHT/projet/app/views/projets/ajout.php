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
    <h1 class="mb-4">Ajouter un nouveau projet</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="label" class="form-label">Label du projet *</label>
            <input type="text" id="label" name="label" class="form-control" value="<?= htmlspecialchars($_POST['label'] ?? '') ?>" required />
        </div>

        <div class="mb-3">
            <label for="groupe" class="form-label">Nombre d'étudiants par groupe *</label>
            <input type="number" id="groupe" name="groupe" class="form-control" min="1" max="5" value="<?= htmlspecialchars($_POST['groupe'] ?? '') ?>" required />
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>

