<?php
class RendezVousModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRendezVousByEtudiant($etudiantId) {
        $sql = "
            SELECT 
                p.label AS projet_label,
                c.creneau AS date_heure,
                pers.nom AS examinateur_nom,
                pers.prenom AS examinateur_prenom
            FROM rdv r
            JOIN creneau c ON r.creneau = c.id
            JOIN projet p ON c.projet = p.id
            JOIN personne pers ON c.examinateur = pers.id
            WHERE r.etudiant = :etudiantId
            ORDER BY c.creneau ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['etudiantId' => $etudiantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Récupère les projets disponibles pour lesquels il y a des créneaux libres
    public function getProjetsAvecCreneauxDisponibles() {
        $sql = "
            SELECT DISTINCT p.id, p.label
            FROM projet p
            JOIN creneau c ON p.id = c.projet
            LEFT JOIN rdv r ON c.id = r.creneau
            WHERE r.id IS NULL
            ORDER BY p.label
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère les créneaux disponibles (non réservés) pour un projet donné
    public function getCreneauxDisponiblesParProjet($projetId) {
        $sql = "
            SELECT c.id, c.creneau, pers.nom, pers.prenom
            FROM creneau c
            JOIN personne pers ON c.examinateur = pers.id
            LEFT JOIN rdv r ON c.id = r.creneau
            WHERE c.projet = :projetId AND r.id IS NULL
            ORDER BY c.creneau
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['projetId' => $projetId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crée un rendez-vous pour un étudiant donné sur un créneau donné
    public function prendreRendezVous($creneauId, $etudiantId) {
        // Vérification rapide que le créneau n'est pas déjà pris
        $checkSql = "SELECT COUNT(*) FROM rdv WHERE creneau = :creneauId";
        $stmt = $this->pdo->prepare($checkSql);
        $stmt->execute(['creneauId' => $creneauId]);
        if ($stmt->fetchColumn() > 0) {
            return false; // déjà pris
        }

        // Insertion
        $insertSql = "INSERT INTO rdv (id, creneau, etudiant) VALUES (NULL, :creneauId, :etudiantId)";
        $stmt = $this->pdo->prepare($insertSql);
        return $stmt->execute(['creneauId' => $creneauId, 'etudiantId' => $etudiantId]);
    }
}
