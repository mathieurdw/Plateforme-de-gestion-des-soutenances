<?php
require_once '/../fragments/fragmentHeader.php';
require_once '/../fragments/fragmentMenu.php';
require_once '/../fragments/fragmentJumbotron.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Les innovations proposées</h1>
    <p class="lead mb-4">Sélectionnez une option pour découvrir nos propositions d'amélioration.</p>

    <div class="d-flex gap-3">
        <a href="?action=fonctionnalite" class="btn btn-primary btn-lg flex-fill">
            Proposer une fonctionnalité originale
        </a>
        <a href="?action=amelioration" class="btn btn-secondary btn-lg flex-fill">
            Proposer une amélioration du code MVC
        </a>
    </div>
</div>

<?php require_once '/../fragments/fragmentFooter.php'; ?>
