<?php
require ('../controllers/CreneauController.php');
require ('../controllers/InnovationController.php');
require ('../controllers/PersonneController.php');
require ('../controllers/ProjetController.php');
require ('../controllers/RendezVousController.php');
require ('../controllers/ConnexionController.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $param);
$action = isset($param["action"]) ? htmlspecialchars($param["action"]) : "caveAccueil";

// Actions possibles
$actionsCreneau = [
  "listeCreneauxExaminateur",
  "listeCreneauxParProjet",
  "ajouterCreneau",
  "ajouterListeCreneaux"
];

$actionsInnovation = [
  "proposeOriginalFeature",
  "proposeMVCImprovement"
];

$actionsPersonne = [  
  "listeExaminateurs",
  "afficherFormulaireAjoutExaminateur",
  "traiterAjoutExaminateur"
];

$actionsProjet = [
  "listeProjetsResponsable",
  "traiterAjoutProjet",
  "choisirProjetExaminateurs",
  "planningProjet",
  "listeProjetsExaminateur"
];

$actionsConnexion = [
  "afficherFormulaireConnexion",
  "verifierConnexion",
  "deconnexion",
  "afficherFormulaireInscription",
  "inscrireUtilisateur"
];

$actionsRendezVous = [
  "listeRendezVous",
  "prendreRdv"
];



// Gestion des actions
if (in_array($action, $actionsCreneau)) {
  CreneauController::$action();
} elseif (in_array($action, $actionsInnovation)) {
  InnovationController::$action();
} elseif (in_array($action, $actionsPersonne)) { 
    PersonneController::$action();
}
elseif (in_array($action, $actionsProjet)) { 
    ProjetController::$action();
}
elseif (in_array($action, $actionsConnexion)) { 
    ConnexionController::$action();
}
elseif (in_array($action, $actionsRendezVous)) { 
    RendezVousController::$action();
}
else {
  InnovationController::Accueil(); 
}
?>
