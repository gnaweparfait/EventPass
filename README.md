# EventPass

Plateforme SaaS de billetterie en ligne type **Eventbrite**, pensée pour l'Afrique (Sénégal et région). Les organisateurs créent et gèrent des événements ; les participants découvrent les événements et achètent des billets (flux d'achat et paiements en cours de développement).

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Lancement](#lancement)
- [Rôles utilisateurs](#rôles-utilisateurs)
- [Routes principales](#routes-principales)
- [Structure du projet](#structure-du-projet)
- [Base de données](#base-de-données)
- [Authentification & profil](#authentification--profil)
- [Espace organisateur](#espace-organisateur)
- [Commandes utiles](#commandes-utiles)
- [Roadmap](#roadmap)
- [Licence](#licence)

---

## Fonctionnalités

### Disponibles

| Module | Description |
|--------|-------------|
| **Authentification** | Inscription, connexion, vérification e-mail, réinitialisation mot de passe (Laravel Breeze) |
| **Rôles** | `organisateur` et `participant` avec redirections adaptées |
| **Profil** | Photo de profil, téléphone, nom, e-mail — modifiable à tout moment |
| **Page d'accueil** | Landing moderne, liste des événements publiés à venir |
| **Dashboard organisateur** | Statistiques (événements, commandes, revenus) |
| **CRUD événements** | Création, édition, suppression, publication, image de couverture |
| **Billetterie (modèle)** | Types de billets liés aux événements, commandes, paiements (structure BDD prête) |

### Prévues

- Achat de billets côté participant
- Paiements **Wave** et **PayDunya**
- QR Code unique par billet (contrôle d'accès)
- API / application mobile (optionnel)

---

## Stack technique

| Couche | Technologie |
|--------|-------------|
| Backend | **Laravel 13** (PHP 8.3+) |
| Frontend | **Blade**, **Tailwind CSS 3**, **Alpine.js** |
| Build | **Vite 8** |
| Base de données | **MySQL** (recommandé) ou SQLite (dev) |
| Auth | **Laravel Breeze** (stack Blade) |
| Stockage fichiers | Disque `public` (images événements, avatars) |

---

## Prérequis

- **PHP** >= 8.3 avec extensions : `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- **Composer** 2.x
- **Node.js** >= 18 et **npm**
- **MySQL** 8+ (production / développement local)
- **Git**

---

## Installation

### 1. Cloner le projet

```bash
git clone <url-du-repo> EventPass
cd EventPass
```

### 2. Dépendances PHP

```bash
composer install
```

### 3. Dépendances front-end

```bash
npm install
```

### 4. Environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Lien symbolique storage (obligatoire pour photos & images)

```bash
php artisan storage:link
```

### 6. Base de données

Configurer MySQL dans `.env` :

```env
APP_NAME=EventPass
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventpass
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

Créer la base :

```sql
CREATE DATABASE eventpass CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Puis migrer :

```bash
php artisan migrate
```

### 7. (Optionnel) Données de test

```bash
php artisan db:seed
```

---

## Configuration

### Variables `.env` importantes

| Variable | Description |
|----------|-------------|
| `APP_NAME` | Nom affiché (ex. `EventPass`) |
| `APP_URL` | URL publique de l'application |
| `DB_*` | Connexion MySQL |
| `MAIL_*` | Envoi des e-mails (vérification, reset password) |
| `FILESYSTEM_DISK` | `local` par défaut ; les uploads publics utilisent le disque `public` |

### E-mail en local

Pour le développement, `MAIL_MAILER=log` écrit les e-mails dans `storage/logs/laravel.log`.

Pour tester avec un vrai SMTP, configurez `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, etc.

---

## Lancement

**Terminal 1 — serveur Laravel :**

```bash
php artisan serve
```

**Terminal 2 — assets Vite (développement) :**

```bash
npm run dev
```

Ouvrir : [http://127.0.0.1:8000](http://127.0.0.1:8000)

> En production, compiler les assets une fois : `npm run build`

### Installation rapide (script Composer)

```bash
composer setup
```

Exécute : `composer install`, copie `.env`, `key:generate`, `migrate`, `npm install`, `npm run build`.

---

## Rôles utilisateurs

| Rôle | Valeur BDD | Accès |
|------|------------|--------|
| **Organisateur** | `organisateur` | `/dashboard`, CRUD `/events`, profil |
| **Participant** | `participant` | Page d'accueil, profil, achat billets (à venir) |

Le rôle est choisi **à l'inscription**. Le middleware `role:organisateur` protège l'espace organisateur.

### Changer le rôle d'un utilisateur existant

```sql
UPDATE users SET role = 'organisateur' WHERE email = 'email@exemple.com';
```

---

## Routes principales

| Méthode | URI | Nom | Accès |
|---------|-----|-----|--------|
| GET | `/` | — | Public |
| GET/POST | `/register` | `register` | Invité |
| GET/POST | `/login` | `login` | Invité |
| GET | `/dashboard` | `dashboard` | Organisateur (auth + verified) |
| Resource | `/events` | `events.*` | Organisateur |
| GET/PATCH/DELETE | `/profile` | `profile.*` | Auth |
| GET | `/home` | `home` | Auth → redirection selon rôle |

Routes auth complètes : `routes/auth.php` (vérif. e-mail, mot de passe oublié, etc.).

---

## Structure du projet

```
EventPass/
├── app/
│   ├── Enums/              # UserRole, EventStatus, OrderStatus, PaymentStatus
│   ├── Http/
│   │   ├── Controllers/    # EventController, DashboardController, ProfileController…
│   │   ├── Middleware/     # EnsureUserRole
│   │   └── Requests/       # StoreEventRequest, UpdateEventRequest, ProfileUpdateRequest
│   ├── Models/             # User, Event, Ticket, Order, Payment
│   ├── Policies/           # EventPolicy
│   └── Support/            # AvatarStorage
├── database/migrations/    # Schéma complet
├── resources/
│   ├── css/app.css         # Tailwind + classes utilitaires (.ep-*)
│   ├── views/
│   │   ├── auth/           # login, register…
│   │   ├── events/         # CRUD Blade
│   │   ├── layouts/        # app, guest, account
│   │   └── profile/
│   └── js/app.js           # Alpine.js
├── routes/web.php
└── public/                 # Point d'entrée + build Vite
```

---

## Base de données

### Tables principales

```
users
  ├── role (organisateur | participant)
  ├── phone, avatar_path
  └── relations: events, orders

events
  ├── user_id (organisateur)
  ├── title, slug, description, lieu, dates, status, image…
  └── relations: tickets, orders

tickets          # Types de billets (tarifs)
  └── event_id, price, quantity, quantity_sold…

orders           # Commandes participants
  └── user_id, event_id, reference, status, total…

order_ticket     # Pivot + qr_code (futur)
payments         # Paiements Wave / PayDunya (futur)
```

### Statuts (Enums)

- **Event** : `draft`, `published`, `cancelled`
- **Order** : `pending`, `paid`, `cancelled`, `refunded`
- **Payment** : `pending`, `completed`, `failed`, `refunded`

### Migrations

```bash
php artisan migrate          # Appliquer
php artisan migrate:fresh    # Réinitialiser (⚠️ supprime les données)
php artisan migrate:status   # État
```

---

## Authentification & profil

### Inscription

Champs requis :

- Nom complet
- E-mail
- **Téléphone** (format : chiffres, `+`, espaces, 8–20 caractères)
- Mot de passe + confirmation
- Rôle (participant / organisateur)
- Photo de profil (optionnelle, max 2 Mo, JPG/PNG/WebP)

### Profil (`/profile`)

- Mise à jour photo (aperçu live Alpine.js)
- Suppression de la photo
- Modification téléphone, nom, e-mail

Fichiers avatars : `storage/app/public/avatars/{user_id}/`

---

## Espace organisateur

### Dashboard

- Nombre d'événements (total / publiés / brouillons)
- Commandes payées
- Revenus totaux (XOF)

### Événements

- Liste avec recherche et filtre par statut
- Création avec validation (`StoreEventRequest`)
- Slug auto-généré unique
- Image stockée dans `storage/app/public/events/`
- Autorisation via `EventPolicy` (un organisateur ne gère que ses événements)

### Publier un événement sur l'accueil

1. Créer l'événement
2. Statut : **Publié**
3. Date de début dans le futur
4. (Optionnel) cocher **Mettre en avant**

---

## Commandes utiles

```bash
# Développement
php artisan serve
npm run dev

# Production assets
npm run build

# Cache (prod)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Qualité code
./vendor/bin/pint

# Tests
php artisan test

# Logs en temps réel
php artisan pail

# Créer un utilisateur Tinker
php artisan tinker
>>> \App\Models\User::factory()->organizer()->create(['email' => 'org@test.com']);
```

### Dépannage courant

| Problème | Solution |
|----------|----------|
| Page sans style CSS | Lancer `npm run dev` ou `npm run build` |
| Images / avatars cassés | `php artisan storage:link` |
| 403 sur `/dashboard` | Compte doit avoir `role = organisateur` |
| Erreur `authorize()` | Vérifier que `Controller` utilise le trait `AuthorizesRequests` |
| MySQL connection refused | Vérifier `DB_*` dans `.env` et que MySQL tourne |

---

## Roadmap

- [ ] Catalogue public événement + page détail
- [ ] Panier et commande participant
- [ ] Génération QR Code par billet
- [ ] Intégration **Wave**
- [ ] Intégration **PayDunya**
- [ ] CRUD types de billets dans l'espace organisateur
- [ ] Scanner / validation QR à l'entrée
- [ ] Notifications (e-mail / SMS)
- [ ] Tableau de bord participant (mes billets)
- [ ] Tests automatisés (Feature / Unit)
- [ ] Déploiement (Forge, VPS, Docker)

---

## Sécurité

- Mots de passe hashés (bcrypt)
- Protection CSRF sur les formulaires
- Policies Laravel sur les événements
- Middleware de rôle
- Validation stricte des uploads (type, taille)
- Vérification e-mail activée sur les routes organisateur (`verified`)

---

## Licence

Projet sous licence **MIT** (voir fichier `LICENSE` fourni avec Laravel).

---

## Auteur & support

**EventPass** — Billetterie en ligne.

Pour toute question technique, ouvrez une issue sur le dépôt ou contactez l'équipe de développement.

---

*Dernière mise à jour : mai 2026 — Laravel 13.x*
