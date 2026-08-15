<?php
// views/about.php
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>À propos</title></head>
<body>
    <h1>À propos</h1>
    <p><?= htmlspecialchars($message) ?></p>
    <a href="<?= $base ?>/">Retour à l'accueil</a>
</body>
</html>