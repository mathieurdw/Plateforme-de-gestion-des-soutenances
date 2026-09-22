<?php
class InnovationController {

    // Affiche la page pour proposer une fonctionnalité originale
public static function proposeOriginalFeature() {
    require_once __DIR__ . '/../views/innovations/innovation_fonctionnalite.php';
}

    // Affiche la page pour proposer une amélioration du code MVC
    public static function proposeMVCImprovement() {
        require_once __DIR__ . '/../views/innovations/innovation_amelioration.php';
    }
    
    public static function Accueil() {
    $root = dirname(__DIR__, 2);
    require_once __DIR__ . '/../views/Accueil.php';
    }
}
?>
