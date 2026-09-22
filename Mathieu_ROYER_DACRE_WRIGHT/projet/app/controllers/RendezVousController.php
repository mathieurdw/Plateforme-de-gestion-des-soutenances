<?php
require_once '../models/Model.php';
require_once '../models/RendezVousModel.php';

class RendezVousController {

    public static function listeRendezVous() {
        
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $pdo = Model::getInstance();
        $model = new RendezVousModel($pdo);

        $etudiantId = $_SESSION['id'] ?? null;
        if (!$etudiantId) {
            die("Identifiant étudiant manquant.");
        }

        $rendezVous = $model->getRendezVousByEtudiant($etudiantId);
        include '../views/rendezvous/liste.php';
    }

    public static function prendreRdv() {
        
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $pdo = Model::getInstance();
        $model = new RendezVousModel($pdo);

        $etudiantId = $_SESSION['id'] ?? null;
        if (!$etudiantId) {
            die("Identifiant étudiant manquant.");
        }

        $message = '';
        $projets = $model->getProjetsAvecCreneauxDisponibles();

        $projetSelectionne = $_POST['projet'] ?? null;
        $creneaux = [];

        if ($projetSelectionne) {
            $creneaux = $model->getCreneauxDisponiblesParProjet($projetSelectionne);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['creneau'])) {
            $creneauId = intval($_POST['creneau']);

            if ($model->prendreRendezVous($creneauId, $etudiantId)) {
                $message = '<div class="alert alert-success">Rendez-vous pris avec succès.</div>';
                $creneaux = $model->getCreneauxDisponiblesParProjet($projetSelectionne);
            } else {
                $message = '<div class="alert alert-danger">Erreur : ce créneau est déjà pris.</div>';
            }
        }

        include '../views/rendezvous/prendre.php';
    }
}
?>
