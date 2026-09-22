<?php
class CreneauModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getCreneauxByExaminateur($examinateurId) {
        $sql = "
            SELECT c.*, p.label AS projet_label
            FROM creneau c
            JOIN projet p ON c.projet = p.id
            WHERE c.examinateur = :examinateurId
            ORDER BY c.creneau
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['examinateurId' => $examinateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Récupère la liste des projets pour lesquels l'examinateur a au moins un créneau
    public function getProjetsByExaminateur($examinateurId) {
        $sql = "
            SELECT DISTINCT PJ.id, PJ.label
            FROM projet PJ
            JOIN creneau CR ON PJ.id = CR.projet
            WHERE CR.examinateur = :examinateurId
            ORDER BY PJ.label
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['examinateurId' => $examinateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère la liste des créneaux d’un examinateur pour un projet donné
    public function getCreneauxByExaminateurAndProjet($examinateurId, $projetId) {
        $sql = "
            SELECT id, creneau
            FROM creneau
            WHERE examinateur = :examinateurId AND projet = :projetId
            ORDER BY creneau DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['examinateurId' => $examinateurId, 'projetId' => $projetId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function ajouterCreneau($projetId, $examinateurId, $datetime) {
        $sql = "INSERT INTO creneau (id, projet, examinateur, creneau) VALUES (NULL, :projet, :examinateur, :creneau)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'projet' => $projetId,
            'examinateur' => $examinateurId,
            'creneau' => $datetime
        ]);
    }
    
    public function ajouterListeCreneaux($projetId, $examinateurId, $dateHeureDebut, $nombre) {
    $sql = "INSERT INTO creneau (id, projet, examinateur, creneau) VALUES (NULL, :projet, :examinateur, :creneau)";
    $stmt = $this->pdo->prepare($sql);

    for ($i = 0; $i < $nombre; $i++) {
        $dateCourante = date('Y-m-d H:i:s', strtotime("+{$i} hour", strtotime($dateHeureDebut)));
        $result = $stmt->execute([
            'projet' => $projetId,
            'examinateur' => $examinateurId,
            'creneau' => $dateCourante
        ]);
        if (!$result) {
            return false;
        }
    }
    return true;
    }
    
    public function getAllProjets() {
    $sql = "SELECT id, label FROM projet ORDER BY label";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}

