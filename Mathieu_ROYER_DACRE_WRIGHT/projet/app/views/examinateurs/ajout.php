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
    <h1 class="mb-4">Ajouter un nouvel examinateur</h1>

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
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($nom) ?></td>
                    <td><?= htmlspecialchars($prenom) ?></td>
                    <td><?= htmlspecialchars($login) ?></td>
                </tr>
            </tbody>
        </table>
        <a href="ajoutExaminateur" class="btn btn-secondary mt-3">Ajouter un autre examinateur</a>
        <a href="listeExaminateurs" class="btn btn-primary mt-3">Voir la liste des examinateurs</a>
    <?php endif; ?>

    <?php if (empty($success)): // Affiche le formulaire seulement si pas de succès ?>
        <form method="post" action="router1.php?action=traiterAjoutExaminateur">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom *</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required />
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom *</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required />
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
