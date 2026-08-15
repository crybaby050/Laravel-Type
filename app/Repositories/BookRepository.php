<?php
declare(strict_types=1);

namespace App\Repositories;

/**
 * Implémentation MySQL du BookRepositoryInterface.
 *
 * Toute la logique SQL est confinée ici : si demain on change de SGBD
 * ou qu'on passe par une API, seule cette classe est à réécrire.
 */
class BookRepository implements BookRepositoryInterface
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT id, titre, auteur FROM livres ORDER BY titre');

        return $statement->fetchAll();
    }
}