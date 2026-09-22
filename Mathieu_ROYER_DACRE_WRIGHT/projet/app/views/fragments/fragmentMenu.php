<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$etudiants = "ROYER DACRE WRIGHT Mathieu";

$nomUtilisateur = $_SESSION['login_name'] ?? null;
$roles = $_SESSION['login_roles'] ?? [];
?>

<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=accueil">
      <?= htmlspecialchars($etudiants) ?>
      <?php if ($nomUtilisateur): ?>
        &nbsp;|&nbsp;<?= htmlspecialchars($nomUtilisateur) ?>
      <?php endif; ?>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if (in_array('responsable', $roles)): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Responsable</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=listeProjetsResponsable">Liste de mes projets</a></li>
              <li><a class="dropdown-item" href="router1.php?action=traiterAjoutProjet">Ajout d’un projet</a></li>
              <li><a class="dropdown-item" href="router1.php?action=listeExaminateurs">Liste des examinateurs</a></li>
              <li><a class="dropdown-item" href="router1.php?action=afficherFormulaireAjoutExaminateur">Ajout d’un examinateur</a></li>
              <li><a class="dropdown-item" href="router1.php?action=choisirProjetExaminateurs">Examinateurs d’un projet</a></li>
              <li><a class="dropdown-item" href="router1.php?action=planningProjet">Planning d’un projet</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (in_array('examinateur', $roles)): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Examinateur</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=listeProjetsExaminateur">Liste des projets</a></li>
              <li><a class="dropdown-item" href="router1.php?action=listeCreneauxExaminateur">Mes créneaux</a></li>
              <li><a class="dropdown-item" href="router1.php?action=listeCreneauxParProjet">Mes créneaux pour un projet</a></li>
              <li><a class="dropdown-item" href="router1.php?action=ajouterCreneau">Ajouter un créneau</a></li>
              <li><a class="dropdown-item" href="router1.php?action=ajouterListeCreneaux">Ajouter une liste de créneaux</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (in_array('etudiant', $roles)): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Étudiant</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=listeRendezVous">Liste de mes rendez-vous</a></li>
              <li><a class="dropdown-item" href="router1.php?action=prendreRdv">Prendre un RDV</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Menu Innovations visible pour tous -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=proposeOriginalFeature">Fonctionnalité originale</a></li>
            <li><a class="dropdown-item" href="router1.php?action=proposeMVCImprovement">Amélioration de la structure</a></li>
          </ul>
        </li>

        <!-- Menu Connexion / Inscription si non connecté -->
        <?php if (!$nomUtilisateur): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuConnexion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Connexion / Inscription
            </a>
            <ul class="dropdown-menu" aria-labelledby="menuConnexion">
              <li><a class="dropdown-item" href="router1.php?action=afficherFormulaireConnexion">Me connecter</a></li>
              <li><a class="dropdown-item" href="router1.php?action=afficherFormulaireInscription">M'inscrire</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Lien Déconnexion visible uniquement si connecté -->
          <li class="nav-item">
            <a class="nav-link" href="router1.php?action=deconnexion">Déconnexion</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
