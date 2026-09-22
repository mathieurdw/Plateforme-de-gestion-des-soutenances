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
    <h1 class="mb-4">Examinateur ajouté avec succès</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($nom) ?></td>

            </tr>
        </tbody>
    </table>

</div>

<?php
require_once __DIR__ . '/../fragments/fragmentFooter.php';
?>
