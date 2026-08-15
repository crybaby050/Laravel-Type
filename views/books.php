<?php
// views/books.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livres</title>
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <a href="<?= $base ?>/">Accueil</a>
            <a href="<?= $base ?>/books">Livres</a>
            <a href="<?= $base ?>/about">À propos</a>
        </nav>

        <h1>Livres</h1>

        <ul class="book-list">
            <?php foreach ($livres as $livre): ?>
                <li>
                    <div class="book-title"><?= htmlspecialchars($livre['titre']) ?></div>
                    <div class="book-author"><?= htmlspecialchars($livre['auteur']) ?></div>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="<?= $base ?>/" class="back-link">← Retour à l'accueil</a>
    </div>
</body>
</html>