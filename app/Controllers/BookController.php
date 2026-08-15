<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\BookRepositoryInterface;
use Core\View;

/**
 * Contrôleur de la ressource "livres".
 *
 * Le Container injecte automatiquement une instance de
 * BookRepositoryInterface (voir le binding dans public/index.php) :
 * ce Controller n'a jamais besoin de faire `new BookRepository(...)` lui-même.
 */
class BookController
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function index(): string
    {
        $livres = $this->repository->findAll();

        return View::render('books', [
            'livres' => $livres,
        ]);
    }
}