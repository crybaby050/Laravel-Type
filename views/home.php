<?php
// views/home.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <a href="<?= $base ?>/">Accueil</a>
            <a href="<?= $base ?>/books">Livres</a>
            <a href="<?= $base ?>/about">À propos</a>
        </nav>

        <h1><?= htmlspecialchars($titre) ?></h1>
        <p>Mini-application PHP construite avec une architecture type Laravel.</p>
    </div>
</body>
</html>