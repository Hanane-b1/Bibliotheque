# Bibliothèque en ligne

Application web de gestion de bibliothèque. Les lecteurs consultent le catalogue et réservent des livres ; l'administrateur gère le fonds et valide les réservations.

## Aperçu

<img alt="Page d'accueil" src="https://github.com/user-attachments/assets/826ae745-86ce-4613-9525-f1ae0cf9fb3b" />

### Espace lecteur

| Catalogue et recherche | Fiche d'un livre |
|---|---|
| <img alt="Catalogue" src="https://github.com/user-attachments/assets/fe775aa7-0cc0-4b2a-aca9-5978485ce8b9" /> | <img alt="Fiche d'un livre" src="https://github.com/user-attachments/assets/11f9fb69-9bd8-4567-943f-2d03c75a37e9" /> |

| Note et réservation | Mes réservations |
|---|---|
| <img alt="Note et réservation" src="https://github.com/user-attachments/assets/c99d5df2-ee55-4d07-872b-d6d740a0a482" /> | <img alt="Mes réservations" src="https://github.com/user-attachments/assets/382363c5-681c-4784-8f49-ef7e465b117f" /> |

### Espace administrateur

<img alt="Tableau de bord administrateur" src="https://github.com/user-attachments/assets/606cd311-abee-480a-b520-9463b3f98d5c" />

## Fonctionnalités

**Espace lecteur**

- Catalogue des livres disponibles, avec recherche par titre ou auteur et filtre par catégorie
- Fiche détaillée de chaque livre
- Réservation avec dates de début et de fin, et suivi du statut (en attente, validée, annulée)
- Note de 1 à 5 étoiles et commentaires
- Gestion du profil

**Espace administrateur**

- Tableau de bord : nombre de livres, d'utilisateurs, de catégories et de réservations en attente
- Gestion des livres (avec image de couverture), des catégories et des utilisateurs
- Validation ou annulation des réservations

**Authentification**

- Inscription, connexion et réinitialisation du mot de passe
- Deux rôles, lecteur et administrateur, avec accès protégé par middleware

## Technologies

Laravel 12 (PHP 8.2), Blade, Tailwind CSS, Alpine.js, Vite, MySQL

## Installation

```bash
git clone https://github.com/Hanane-b1/Bibliotheque.git
cd Bibliotheque
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configurer la base de données dans `.env`, puis :

```bash
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Les seeders créent un compte administrateur, des catégories et des livres d'exemple.

## Auteur

Hanane Belhadi
