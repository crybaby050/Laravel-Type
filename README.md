# Atelier 17 — Architecture type Laravel

**Objectif** : assembler toutes les notions dans une mini-application à l'architecture de Laravel : front-controller, router, controllers, views, container.

---

## 1. L'architecture Laravel en un schéma

```
Requête HTTP
    │
    ▼
public/index.php          ← FRONT-CONTROLLER : point d'entrée UNIQUE
    │
    ▼
Router                    ← route la requête vers un Controller
    │
    ▼
Controller                ← reçoit la requête, appelle Services/Repositories, renvoie une View
    │
    ├── Service           ← règles métier
    ├── Repository        ← accès aux données (PDO)
    └── View              ← rendu HTML
```

Tout passe par `public/index.php`. Il n'y a plus de page `.php` éparpillée : les URL sont
**mappées** vers des actions de contrôleurs.

## 2. Le front-controller

```php
// public/index.php
require __DIR__ . '/../bootstrap/autoload.php';

$container = new Container();
$container->bind(BookRepositoryInterface::class, fn ($c) => new BookRepository(Database::connect()));

$router = new Router();
require __DIR__ . '/../routes/web.php';   // enregistre les routes

$router->dispatch($_SERVER['REQUEST_METHOD'], $path, $container);
```

## 3. Le Router

```php
class Router
{
    public function add(string $method, string $path, array $action): void { /* ... */ }

    public function dispatch(string $method, string $path, Container $container): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                [$class, $action] = $route['action'];
                $controller = $container->make($class);   // construit via le container !
                echo $controller->{$action}();
                return;
            }
        }
        http_response_code(404);
        echo '404 - Page introuvable';
    }
}
```

## 4. Les routes

```php
// routes/web.php
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/books', [BookController::class, 'index']);
```

## 5. Le contrôleur renvoie une vue

```php
class BookController
{
    public function __construct(private BookRepositoryInterface $repository) {}

    public function index(): string
    {
        $livres = $this->repository->findAll();
        return View::render('books', ['livres' => $livres]);
    }
}
```

## 6. La vue (mini template)

```php
// views/books.php — le HTML avec $livres disponible
<?php foreach ($livres as $livre): ?>
    <div>...<?= $livre['titre'] ?>...</div>
<?php endforeach; ?>
```

`View::render()` extrait les données dans la portée du template.

## 7. Le dossier `public/` 

Seul `public/` est exposé par le serveur (Apache document root pointerait ici).
Toute la logique (`app/`, `core/`, `routes/`) reste hors de portée du navigateur → sécurité.

## 8. Exercice guidé

**Objectif** : ajouter une route et une vue.

1. Explorez `exemples/` (front-controller → routes → controllers → views).
2. Ajoutez une route `GET /about` → `HomeController@about`.
3. Créez la méthode `about()` dans `HomeController` et la vue `views/about.php`.
4. Testez `.../public/index.php` puis `.../public/about`.

> ⚠️ L'URL réelle dépend de votre serveur : `http://localhost/cours-php/atelier-17-.../exemples/public`

### Solution

```php
// routes/web.php
$router->add('GET', '/about', [HomeController::class, 'about']);

// HomeController
public function about(): string
{
    return View::render('about', ['message' => 'Mini-application type Laravel']);
}

// views/about.php : affiche <?= $message ?>
```

## Ce qu'il faut retenir

- **Front-controller** : un seul point d'entrée (`public/index.php`).
- **Router** : associe méthode+URL → `Controller@action`.
- **Container** : construit les contrôleurs et injecte leurs dépendances.
- **View** : sépare le HTML du contrôleur.
- C'est exactement le squelette de Laravel : `public/index.php`, `routes/web.php`, `app/Controllers`, `resources/views`.
