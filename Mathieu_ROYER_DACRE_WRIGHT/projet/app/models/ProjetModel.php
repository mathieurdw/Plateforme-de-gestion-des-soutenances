<?php
class ProjetModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProjets() {
    $sql = "SELECT * FROM projet ORDER BY label";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Récupération des projets existants 
    public function getProjetsByResponsable($responsableId) {
        $sql = "
            SELECT 
                p.id, 
                p.label, 
                p.groupe,
                per.nom AS responsable_nom,
                per.prenom AS responsable_prenom
            FROM projet p
            JOIN personne per ON p.responsable = per.id
            WHERE p.responsable = :responsableId
            ORDER BY p.label
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['responsableId' => $responsableId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Insertion d’un nouveau projet
    public function ajouterProjet($label, $responsable, $groupe) {
        // IMPORTANT : Ne pas insérer 'id', laisser MySQL gérer l'auto-increment
        $sql = "INSERT INTO projet (label, responsable, groupe) VALUES (:label, :responsable, :groupe)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':label' => $label,
            ':responsable' => $responsable,
            ':groupe' => $groupe
        ]);
    }
    
    public function getProjetsResponsable($responsableId) {
        $sql = "SELECT id, label FROM projet WHERE responsable = :responsable ORDER BY label";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':responsable' => $responsableId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExaminateursByProjet($projetId) {
        $sql = "
            SELECT DISTINCT p.id, p.nom, p.prenom
            FROM creneau c
            JOIN personne p ON c.examinateur = p.id
            WHERE c.projet = :projetId
            ORDER BY p.nom, p.prenom
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':projetId' => $projetId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRdvByProjet($projetId) {
        $sql = "
            SELECT 
                R.id AS rdv_id,
                ET.nom AS etudiant_nom,
                ET.prenom AS etudiant_prenom,
                C.creneau,
                EX.nom AS examinateur_nom,
                EX.prenom AS examinateur_prenom
            FROM rdv R
            JOIN creneau C ON R.creneau = C.id
            JOIN personne ET ON R.etudiant = ET.id
            JOIN personne EX ON C.examinateur = EX.id
            WHERE C.projet = :projetId
            ORDER BY C.creneau
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':projetId' => $projetId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProjetsByExaminateur($examinateurId) {
        $sql = "
            SELECT DISTINCT PJ.id, PJ.label, PJ.groupe, P.nom, P.prenom
            FROM projet PJ
            JOIN creneau CR ON PJ.id = CR.projet
            JOIN personne P ON PJ.responsable = P.id
            WHERE CR.examinateur = :examinateurId
            ORDER BY PJ.label
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':examinateurId' => $examinateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
