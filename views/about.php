<?php
// views/about.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos</title>
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <a href="<?= $base ?>/">Accueil</a>
            <a href="<?= $base ?>/books">Livres</a>
            <a href="<?= $base ?>/about">À propos</a>
        </nav>

        <h1>À propos</h1>
        <p><?= htmlspecialchars($message) ?></p>

        <a href="<?= $base ?>/" class="back-link">← Retour à l'accueil</a>
    </div>
</body>
</html>