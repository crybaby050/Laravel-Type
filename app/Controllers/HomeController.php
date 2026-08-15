<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

/**
 * Contrôleur de la page d'accueil et des pages statiques simples.
 *
 * Pas de dépendance ici (pas de constructeur), ce qui montre que le
 * Container sait aussi instancier des classes "sans besoins" via
 * ReflectionClass::newInstance() dans Container::resolve().
 */
class HomeController
{
    public function index(): string
    {
        return View::render('home', [
            'titre' => 'Bienvenue',
        ]);
    }

    public function about(): string
    {
        return View::render('about', [
            'message' => 'Mini-application type Laravel',
        ]);
    }
}