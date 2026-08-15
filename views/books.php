<?php
// views/books.php
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Livres</title></head>
<body>
    <h1>Liste des livres</h1>
    <ul>
        <?php foreach ($livres as $livre): ?>
            <li>
                <?= htmlspecialchars($livre['titre']) ?>
                — <?= htmlspecialchars($livre['auteur']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?= $base ?>/">Retour à l'accueil</a>
</body>
</html>