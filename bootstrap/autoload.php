<?php
declare(strict_types=1);

/**
 * bootstrap/autoload.php
 *
 * Rôle :
 *  1. Définir les constantes de chemins utilisées dans toute l'application.
 *  2. Charger les variables d'environnement depuis .env.
 *  3. Enregistrer un autoloader PSR-4 "maison" qui mappe un namespace
 *     racine à un dossier physique, sans dépendre de Composer.
 */

define('BASE_PATH', dirname(__DIR__));
define('VIEW_PATH', BASE_PATH . '/views');

$namespaceMap = [
    'Core\\'                => BASE_PATH . '/core/',
    'App\\Controllers\\'    => BASE_PATH . '/app/Controllers/',
    'App\\Repositories\\'   => BASE_PATH . '/app/Repositories/',
];

spl_autoload_register(function (string $class) use ($namespaceMap): void {
    foreach ($namespaceMap as $prefix => $directory) {
        if (str_starts_with($class, $prefix)) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $directory . str_replace('\\', '/', $relativeClass) . '.php';

            if (is_file($file)) {
                require $file;
                return;
            }
        }
    }
});

// Le chargement du .env doit se faire APRÈS l'enregistrement de
// l'autoloader, car Core\Env doit pouvoir être autoloadée.
\Core\Env::load(BASE_PATH . '/.env');