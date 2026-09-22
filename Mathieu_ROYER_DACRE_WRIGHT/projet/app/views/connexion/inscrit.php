<?php
// Inclusion des fragments
require_once __DIR__ . '/../fragments/fragmentHeader.php';
?>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentMenu.php';
require_once __DIR__ . '/../fragments/fragmentJumbotron.php';

?>

<h2>Inscription réussie</h2>
<p>Voici le récapitulatif des informations que vous avez fournies :</p>

<table class="table table-bordered w-50">
  <tbody>
    <tr>
      <th>Nom</th>
      <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
    </tr>
    <tr>
      <th>Prénom</th>
      <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
    </tr>
    <tr>
      <th>Login</th>
      <td><?= htmlspecialchars($utilisateur['login']) ?></td>
    </tr>
    <tr>
      <th>Rôles</th>
      <td>
        <?php
        $roles = [];
        if (!empty($utilisateur['role_responsable'])) $roles[] = 'Responsable';
        if (!empty($utilisateur['role_examinateur'])) $roles[] = 'Examinateur';
        if (!empty($utilisateur['role_etudiant'])) $roles[] = 'Étudiant';
        echo htmlspecialchars(implode(', ', $roles)) ?: 'Aucun rôle attribué';
        ?>
      </td>
    </tr>
  </tbody>
</table>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
