<?php
declare(strict_types=1);

/**
 * Configuration de connexion à la base de données.
 *
 * Les valeurs proviennent du fichier .env (chargé dans
 * bootstrap/autoload.php via Core\Env::load()). Le second argument
 * de getenv() sert de valeur par défaut si la variable est absente.
 */
return [
    'host'     => getenv('DB_HOST') ?: 'localhost',
    'dbname'   => getenv('DB_DATABASE') ?: '',
    'user'     => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
];