<?php
require_once '../models/CreneauModel.php';
require_once '../models/Model.php';

class CreneauController {

    // Liste des créneaux d’un examinateur
    public static function listeCreneauxExaminateur() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Model::getInstance();
        $model = new CreneauModel($pdo);

        $examinateurId = $_SESSION['id'] ?? null;
        if (!$examinateurId) {
            die("Identifiant examinateur manquant.");
        }

        $creneaux = $model->getCreneauxByExaminateur($examinateurId);
        include '../views/creneaux/liste_examinateur.php';
    }


    public static function listeCreneauxParProjet() {
        
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        
        $pdo = Model::getInstance();
        $model = new CreneauModel($pdo);


        $examinateurId = $_SESSION['id'] ?? null;
        if (!$examinateurId) {
            die("Identifiant examinateur manquant.");
        }

        $projets = $model->getProjetsByExaminateur($examinateurId);
        $creneaux = [];
        $selectedProjetId = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['projet_id'])) {
            $selectedProjetId = (int)$_POST['projet_id'];
            $creneaux = $model->getCreneauxByExaminateurAndProjet($examinateurId, $selectedProjetId);
        }

        include '../views/creneaux/liste_par_projet.php';
    }

    public static function ajouterCreneau() {
       if (session_status() === PHP_SESSION_NONE) {
           session_start();
       }

       $pdo = Model::getInstance();
       $model = new CreneauModel($pdo);

       $examinateurId = $_SESSION['id'] ?? null;
       if (!$examinateurId) {
           die("Identifiant examinateur manquant.");
       }

       // Récupérer tous les projets, pas seulement ceux liés à l'examinateur
       $projets = $model->getAllProjets();

       $errors = [];
       $success = false;

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $projetId = $_POST['projet_id'] ?? null;
           $dateHeure = $_POST['date_heure'] ?? null;

           if (empty($projetId)) {
               $errors[] = "Veuillez sélectionner un projet.";
           }
           if (empty($dateHeure)) {
               $errors[] = "Veuillez renseigner la date et l'heure du créneau.";
           } elseif (!strtotime($dateHeure)) {
               $errors[] = "Format de date/heure invalide.";
           }

           if (empty($errors)) {
               $result = $model->ajouterCreneau($projetId, $examinateurId, $dateHeure);
               $success = $result;
               if (!$result) {
                   $errors[] = "Erreur lors de l'ajout du créneau.";
               }
           }
       }

       include '../views/creneaux/ajouter.php';
   }


    public static function ajouterListeCreneaux() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $pdo = Model::getInstance();
    $model = new CreneauModel($pdo);

    $examinateurId = $_SESSION['id'] ?? null;
    if (!$examinateurId) {
        die("Identifiant examinateur manquant.");
    }

    $projets = $model->getAllProjets(); // récupère tous les projets
    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $projetId = $_POST['projet_id'] ?? null;
        $dateHeureDebut = $_POST['date_heure_debut'] ?? null;
        $nombre = intval($_POST['nombre'] ?? 0);

        if (empty($projetId)) {
            $errors[] = "Veuillez sélectionner un projet.";
        }
        if (empty($dateHeureDebut)) {
            $errors[] = "Veuillez renseigner la date et l'heure de début.";
        } elseif (!strtotime($dateHeureDebut)) {
            $errors[] = "Format de date/heure invalide.";
        }
        if ($nombre < 1 || $nombre > 10) {
            $errors[] = "Le nombre de créneaux doit être compris entre 1 et 10.";
        }

        if (empty($errors)) {
            $result = $model->ajouterListeCreneaux($projetId, $examinateurId, $dateHeureDebut, $nombre);
            $success = $result;
            if (!$result) {
                $errors[] = "Erreur lors de l'ajout des créneaux.";
            }
        }
    }

    include '../views/creneaux/ajouter_liste.php';
    }
}
?>
