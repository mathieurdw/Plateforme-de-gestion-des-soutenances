<?php
require_once __DIR__ . '/../../outil/Connexion.php';

class PersonneModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllExaminateurs() {
        $sql = "SELECT id, nom, prenom, login FROM personne WHERE role_examinateur = TRUE ORDER BY nom, prenom";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterExaminateur($nom, $prenom) {
        $loginBase = strtolower($nom . '.' . $prenom);
        $login = $loginBase;
        $stmtCheck = $this->pdo->prepare("SELECT COUNT(*) FROM personne WHERE login = :login");
        $i = 1;
        do {
            $stmtCheck->execute(['login' => $login]);
            if ($stmtCheck->fetchColumn() > 0) {
                $login = $loginBase . $i;
                $i++;
            } else {
                break;
            }
        } while(true);

        // Hasher le mot de passe (ici 'secret' par défaut)
        $password = 'secret';

        $sql = "INSERT INTO personne 
                (nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password)
                VALUES (:nom, :prenom, FALSE, TRUE, FALSE, :login, :password)";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'login' => $login,
            'password' => $password
        ]);

        if (!$result) {
            error_log("Erreur SQL : " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        return $login;
    }

      public static function getByLogin($login) {
    $sql = "SELECT * FROM personne WHERE login = :login";
    $stmt = Connexion::getInstance()->prepare($sql);
    $stmt->execute(['login' => $login]);
    return $stmt->fetch();
  }

  public static function genererNouvelId() {
    $sql = "SELECT MAX(id) AS max_id FROM personne";
    $stmt = Connexion::getInstance()->query($sql);
    $row = $stmt->fetch();
    return $row ? $row['max_id'] + 1 : 1;
  }

  public static function creerUtilisateur($data) {
    $sql = "INSERT INTO personne 
      (id, nom, prenom, login, password, role_responsable, role_examinateur, role_etudiant)
      VALUES (:id, :nom, :prenom, :login, :password, :role_responsable, :role_examinateur, :role_etudiant)";
    
    $stmt = Connexion::getInstance()->prepare($sql);
    return $stmt->execute($data);
  }
}
