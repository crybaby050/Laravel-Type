<?php
declare(strict_types=1);

namespace Core;

/**
 * Chargeur minimaliste de fichier .env.
 *
 * Parse un fichier KEY=VALUE ligne par ligne et injecte chaque
 * variable dans $_ENV et putenv(), pour qu'elles soient accessibles
 * partout via getenv('DB_HOST') par exemple.
 *
 * Volontairement simple : pas de gestion des sections, quotes
 * imbriquées, etc. Suffisant pour un usage pédagogique.
 */
class Env
{
    private static bool $loaded = false;

    public static function load(string $path): void
    {
        if (self::$loaded || !is_file($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // On ignore les commentaires et les lignes vides/mal formées
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"'"); // enlève espaces + guillemets éventuels

            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
        }

        self::$loaded = true;
    }
}