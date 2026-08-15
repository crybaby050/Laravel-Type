<?php
declare(strict_types=1);

use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use Core\Container;
use Core\Database;
use Core\Router;

/**
 * public/index.php
 *
 * UNIQUE point d'entrée de l'application (front-controller).
 * C'est le seul fichier PHP exposé publiquement par le serveur web ;
 * tout le reste (app/, core/, routes/, config/) est hors de portée
 * directe du navigateur — c'est la base de la sécurité de l'archi.
 */

require __DIR__ . '/../bootstrap/autoload.php';

// --- 1. Configuration du conteneur d'injection de dépendances -------------
$container = new Container();

// On dit au container : "quand quelqu'un demande BookRepositoryInterface,
// donne-lui une instance de BookRepository connectée à la BDD".
$container->bind(
    BookRepositoryInterface::class,
    fn (Container $c) => new BookRepository(Database::connect())
);

// --- 2. Chargement des routes ----------------------------------------------
$router = new Router();
require __DIR__ . '/../routes/web.php';

// --- 3. Récupération des infos de la requête HTTP courante -----------------
$method = $_SERVER['REQUEST_METHOD'];

// On isole le chemin de l'URL (sans query string ni sous-dossier du projet)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($scriptDir !== '/' && str_starts_with($path, $scriptDir)) {
    $path = substr($path, strlen($scriptDir));
}
$path = $path === '' ? '/' : $path;

// --- 4. Dispatch : le Router trouve le bon Controller et l'exécute ---------
$router->dispatch($method, $path, $container);