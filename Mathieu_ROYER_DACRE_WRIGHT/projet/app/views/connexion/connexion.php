<?php
// Inclusions des fragments
require_once __DIR__ . '/../fragments/fragmentHeader.php';
?>
<br><br>
<?php
require_once __DIR__ . '/../fragments/fragmentMenu.php';
require_once __DIR__ . '/../fragments/fragmentJumbotron.php';
?>
<form method="POST" action="router1.php?action=verifierConnexion">
  <input type="text" name="login" placeholder="Login" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">Connexion</button>
</form>


<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>