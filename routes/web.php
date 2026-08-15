<?php
declare(strict_types=1);

use App\Controllers\BookController;
use App\Controllers\HomeController;

/**
 * routes/web.php
 *
 * Table de routage de l'application : chaque ligne associe
 * une méthode HTTP + une URL à une action de contrôleur.
 *
 * Ce fichier suppose qu'une variable $router (instance de Core\Router)
 * existe déjà dans le scope appelant — voir public/index.php.
 */
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/about', [HomeController::class, 'about']);
$router->add('GET', '/books', [BookController::class, 'index']);