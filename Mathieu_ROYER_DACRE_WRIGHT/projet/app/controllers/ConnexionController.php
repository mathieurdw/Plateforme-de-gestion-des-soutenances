<?php

require_once __DIR__ . '/../models/PersonneModel.php';

class ConnexionController {

  public static function afficherFormulaireConnexion() {
    require_once __DIR__ . '/../views/connexion/connexion.php';
  }

public static function verifierConnexion() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    $utilisateur = PersonneModel::getByLogin($login);
    if ($utilisateur && $utilisateur['password'] === $password) {
        $_SESSION['id'] = $utilisateur['id'];  
        $_SESSION['login_name'] = $utilisateur['prenom'] . ' ' . $utilisateur['nom'];

        $_SESSION['login_roles'] = [];
        if ($utilisateur['role_responsable']) {
            $_SESSION['login_roles'][] = 'responsable';
        }
        if ($utilisateur['role_examinateur']) {
            $_SESSION['login_roles'][] = 'examinateur';
        }
        if ($utilisateur['role_etudiant']) {
            $_SESSION['login_roles'][] = 'etudiant';
        }

        header('Location: router1.php?action=accueil');
        exit;
    } else {
        $erreur = "Identifiants incorrects.";
        require_once __DIR__ . '/../views/connexion/connexion.php';
    }
}
public static function deconnexion() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();

    // Empêcher la mise en cache du navigateur
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    header('Location: router1.php?action=accueil');
    exit;
}

   public static function afficherFormulaireInscription() {
    require_once __DIR__ . '/../views/connexion/inscription.php';
  }

public static function inscrireUtilisateur() {
    $data = [
      'id' => PersonneModel::genererNouvelId(),
      'nom' => $_POST['nom'],
      'prenom' => $_POST['prenom'],
      'login' => $_POST['login'],
      'password' => $_POST['password'],
      'role_responsable' => isset($_POST['role_responsable']) ? 1 : 0,
      'role_examinateur' => isset($_POST['role_examinateur']) ? 1 : 0,
      'role_etudiant' => isset($_POST['role_etudiant']) ? 1 : 0
    ];

    if (PersonneModel::creerUtilisateur($data)) {
      $utilisateur = $data;
      require_once __DIR__ . '/../views/connexion/inscrit.php';
      exit;
    } else {
      $erreur = "Erreur lors de l'inscription.";
      require_once __DIR__ . '/../views/connexion/Acceuil.php';
    }
}

}
?>