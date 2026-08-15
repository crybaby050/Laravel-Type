<?php
// views/home.php
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title><?= htmlspecialchars($titre) ?></title></head>
<body>
    <h1><?= htmlspecialchars($titre) ?></h1>
    <nav>
        <a href="<?= $base ?>/">Accueil</a> |
        <a href="<?= $base ?>/books">Livres</a> |
        <a href="<?= $base ?>/about">À propos</a>
    </nav>
</body>
</html>