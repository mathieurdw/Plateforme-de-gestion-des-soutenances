<?php
// Inclusions des fragments
require_once __DIR__ . '/../fragments/fragmentHeader.php';
?>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentMenu.php';
require_once __DIR__ . '/../fragments/fragmentJumbotron.php';
?>


<div class="container mt-5">
    <h1>Amélioration proposée pour le code MVC</h1>
    <hr>
    <p>
        <strong>Adoption d’un routeur centralisé avec gestion dynamique des vues et découplage renforcé</strong>
    </p>
    <p>
        Utiliser un routeur central unique qui analyse les requêtes, invoque les contrôleurs appropriés, et charge les vues via un moteur de templates.
    </p>
    <p><em>Principaux points :</em></p>
    <ul>
        <li>Centralisation des routes dans un fichier dédié.</li>
        <li>Système de templates (ex: Twig) pour séparer présentation et logique.</li>
        <li>Injection de dépendances pour testabilité.</li>
        <li>Utilisation de DTO pour échange de données entre modèles et vues.</li>
    </ul>
    <p><strong>Avantages :</strong></p>
    <ul>
        <li>Maintenabilité et extensibilité accrues.</li>
        <li>Tests unitaires facilités.</li>
        <li>Sécurité renforcée via centralisation des contrôles.</li>
    </ul>

    <br>
</div>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>