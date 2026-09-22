<?php
require_once '../models/Model.php';
require_once '../models/PersonneModel.php';

class PersonneController {

    public static function listeExaminateurs() {
        $pdo = Model::getInstance();
        $model = new PersonneModel($pdo);

        $examinateurs = $model->getAllExaminateurs();
        include '../views/examinateurs/liste.php';
    }

    public static function afficherFormulaireAjoutExaminateur() {
        $errors = [];
        $success = null;
        include '../views/examinateurs/ajout.php';
    }

    public static function traiterAjoutExaminateur() {
    $pdo = Model::getInstance();
    $model = new PersonneModel($pdo);

    $errors = [];
    $success = null;

    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');

    if ($nom === '') {
        $errors[] = "Le nom est obligatoire.";
    }
    if ($prenom === '') {
        $errors[] = "Le prénom est obligatoire.";
    }

    if (empty($errors)) {
        // Appelle la méthode pour ajouter l'examinateur
        $login = $model->ajouterExaminateur($nom, $prenom);

        if ($login) {
            $success = "Examinateur ajouté avec succès.";
            // On inclut la vue formulaire avec le message de succès et le login créé
            include '../views/examinateurs/ajout.php';
            return;
        } else {
            $errors[] = "Erreur lors de l'ajout en base.";
        }
    }

    // S'il y a des erreurs, ou échec, on réaffiche le formulaire avec les erreurs
    include '../views/examinateurs/ajout.php';
}
   

}
?>
