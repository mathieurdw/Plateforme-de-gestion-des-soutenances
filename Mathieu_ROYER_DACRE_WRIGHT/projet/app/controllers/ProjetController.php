<?php
require_once '../models/Model.php';
require_once '../models/ProjetModel.php';

class ProjetController {

public static function listeProjetsResponsable() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $pdo = Model::getInstance();
    $model = new ProjetModel($pdo);

    $responsableId = $_SESSION['id'] ?? null;
    if (!$responsableId) {
        die("Identifiant responsable manquant.");
    }

    // Récupère les projets avec les noms du responsable
    $projets = $model->getProjetsByResponsable($responsableId);

    include '../views/projets/liste.php';
}


    public static function traiterAjoutProjet() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Model::getInstance();
        $model = new ProjetModel($pdo);

        $responsableId = $_SESSION['id'] ?? null;
        if (!$responsableId) {
            die("Identifiant responsable manquant.");
        }

        $errors = [];
        $success = null;

        $label = trim($_POST['label'] ?? '');
        $groupe = (int)($_POST['groupe'] ?? 0);

        if ($label === '') {
            $errors[] = "Le label du projet est obligatoire.";
        }
        if ($groupe < 1 || $groupe > 5) {
            $errors[] = "Le nombre d'étudiants par groupe doit être compris entre 1 et 5.";
        }

        if (empty($errors)) {
            $ok = $model->ajouterProjet($label, $responsableId, $groupe);
            if ($ok) {
                $success = "Projet ajouté avec succès.";
                include '../views/projets/ajout.php';
                return;
            } else {
                $errors[] = "Erreur lors de l'ajout du projet en base.";
            }
        }

        include '../views/projets/ajout.php';
    }

    public static function choisirProjetExaminateurs() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Model::getInstance();
        $model = new ProjetModel($pdo);

        $responsableId = $_SESSION['id'] ?? null;
        if (!$responsableId) {
            die("Identifiant responsable manquant.");
        }

        $projets = $model->getProjetsByResponsable($responsableId);
        $examinateurs = null;
        $projetSelectionne = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projetId = $_POST['projet'] ?? null;
            if ($projetId) {
                $examinateurs = $model->getExaminateursByProjet($projetId);
                foreach ($projets as $p) {
                    if ($p['id'] == $projetId) {
                        $projetSelectionne = $p;
                        break;
                    }
                }
            }
        }

        include '../views/projets/examinateurs.php';
    }

    public static function planningProjet() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Model::getInstance();
        $model = new ProjetModel($pdo);

        $responsableId = $_SESSION['id'] ?? null;
        if (!$responsableId) {
            die("Identifiant responsable manquant.");
        }

        $projets = $model->getProjetsByResponsable($responsableId);
        $rdvs = null;
        $projetSelectionne = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projetId = $_POST['projet'] ?? null;
            if ($projetId) {
                $rdvs = $model->getRdvByProjet($projetId);
                foreach ($projets as $p) {
                    if ($p['id'] == $projetId) {
                        $projetSelectionne = $p;
                        break;
                    }
                }
            }
        }

        include '../views/projets/planning.php';
    }

    public static function listeProjetsExaminateur() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Model::getInstance();
        $model = new ProjetModel($pdo);

        $examinateurId = $_SESSION['id'] ?? null;
        if (!$examinateurId) {
            die("Identifiant examinateur manquant.");
        }

        $projets = $model->getProjetsByExaminateur($examinateurId);
        include '../views/projets/liste_examinateur.php';
    }
}
?>
