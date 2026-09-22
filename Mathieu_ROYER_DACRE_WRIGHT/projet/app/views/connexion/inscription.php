<?php
// Inclusions des fragments
require_once __DIR__ . '/../fragments/fragmentHeader.php';
?>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentMenu.php';
require_once __DIR__ . '/../fragments/fragmentJumbotron.php';
?>

<form method="POST" action="router1.php?action=inscrireUtilisateur">
  <input type="text" name="nom" placeholder="Nom" required>
  <input type="text" name="prenom" placeholder="Prénom" required>
  <input type="text" name="login" placeholder="Login" required>
  <input type="password" name="password" placeholder="Mot de passe" required>

  <label><input type="checkbox" name="role_responsable"> Responsable</label>
  <label><input type="checkbox" name="role_examinateur"> Examinateur</label>
  <label><input type="checkbox" name="role_etudiant"> Étudiant</label>

  <button type="submit">S’inscrire</button>
</form>


<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>