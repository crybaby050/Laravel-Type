-- =============================================================
-- schema.sql
--
-- Script de création de la base de données pour l'Atelier 17.
-- À exécuter une seule fois (via phpMyAdmin, ou en ligne de
-- commande : mysql -u root -p < database/schema.sql)
-- =============================================================

-- 1. Création de la base de données ----------------------------
CREATE DATABASE IF NOT EXISTS atelier17
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE atelier17;

-- 2. Table `livres` ----------------------------------------------
-- Correspond aux colonnes lues dans BookRepository::findAll()
-- (id, titre, auteur).
CREATE TABLE IF NOT EXISTS livres (
    id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre  VARCHAR(150) NOT NULL,
    auteur VARCHAR(100) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- 3. Données de test / valeurs par défaut -------------------------
INSERT INTO livres (titre, auteur) VALUES
    ('Le Petit Prince',              'Antoine de Saint-Exupéry'),
    ('Une si longue lettre',         'Mariama Bâ'),
    ('L''Étranger',                  'Albert Camus'),
    ('Les Bouts de bois de Dieu',    'Ousmane Sembène'),
    ('1984',                         'George Orwell');