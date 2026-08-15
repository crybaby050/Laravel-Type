<?php
declare(strict_types=1);

/**
 * bootstrap/autoload.php
 *
 * Rôle :
 *  1. Définir les constantes de chemins utilisées dans toute l'application.
 *  2. Enregistrer un autoloader PSR-4 "maison" qui mappe un namespace
 *     racine à un dossier physique, sans dépendre de Composer.
 *
 * Ce fichier est le PREMIER inclus par public/index.php.
 */

// Racine du projet (un niveau au-dessus de bootstrap/)
define('BASE_PATH', dirname(__DIR__));

// Dossier des templates, utilisé par Core\View::render()
define('VIEW_PATH', BASE_PATH . '/views');

/**
 * Mapping namespace => dossier physique.
 * Équivalent simplifié du bloc "autoload" de composer.json.
 */
$namespaceMap = [
    'Core\\'                => BASE_PATH . '/core/',
    'App\\Controllers\\'    => BASE_PATH . '/app/Controllers/',
    'App\\Repositories\\'   => BASE_PATH . '/app/Repositories/',
];

spl_autoload_register(function (string $class) use ($namespaceMap): void {
    foreach ($namespaceMap as $prefix => $directory) {
        // Le namespace de la classe commence-t-il par ce préfixe ?
        if (str_starts_with($class, $prefix)) {
            // On retire le préfixe, il reste le chemin relatif de la classe
            $relativeClass = substr($class, strlen($prefix));

            // Namespace -> chemin de fichier (App\Foo\Bar -> Foo/Bar.php)
            $file = $directory . str_replace('\\', '/', $relativeClass) . '.php';

            if (is_file($file)) {
                require $file;
                return;
            }
        }
    }
});