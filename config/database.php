<?php
declare(strict_types=1);

/**
 * Configuration de connexion à la base de données.
 *
 * Ce fichier ne fait QUE retourner un tableau : il est volontairement
 * "bête" pour rester facile à surcharger (variables d'environnement,
 * fichier .env, etc.) sans toucher au reste de l'application.
 */
return [
    'host'     => 'localhost',
    'dbname'   => 'atelier17',
    'user'     => 'root',
    'password' => '',
];