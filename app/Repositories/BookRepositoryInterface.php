<?php
declare(strict_types=1);

namespace App\Repositories;

/**
 * Contrat d'accès aux données pour les livres.
 *
 * Le Controller ne connaît QUE cette interface : il ignore comment
 * les données sont réellement stockées (MySQL, fichier, API externe...).
 * Ce découplage est ce qui rend le code testable (on peut injecter
 * un faux repository en test unitaire).
 */
interface BookRepositoryInterface
{
    /**
     * @return array<int, array<string, mixed>> Liste des livres
     */
    public function findAll(): array;
}