# Système d'Authentification & Gestion de Compte - API Laravel

Ce projet est une API backend robuste développée en Laravel. Elle offre
un système complet de gestion de l'identité utilisateur, incluant la
création de compte, l'authentification sécurisée par token, ainsi que la
consultation et la modification des données de profil.

L'API est conçue pour être consommée par n'importe quel client
(frontend, application mobile) et est entièrement testable via Postman.

## 🛠 Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine
: - **PHP** (v8.1 ou supérieure) - **Composer** - **MySQL** ou
**MariaDB** - **Postman** (pour explorer et tester l'API) -
*(Optionnel)* **Docker** et **Docker Compose** (si vous utilisez Laravel
Sail)

## 🚀 Installation et Configuration

### 1. Cloner le dépôt

``` bash
git clone https://github.com/Oussama-Ait-Youss/System-d-Athentification-Gestion-de-Compte---API-
```

### 2. Installer les dépendances

``` bash
composer install
```

### 3. Configuration de l'environnement

Copiez le fichier d'exemple pour créer votre propre fichier de
configuration :

``` bash
cp .env.example .env
```

Générez ensuite la clé de l'application :

``` bash
php artisan key:generate
```

### 4. Base de données

Ouvrez votre fichier `.env` et configurez vos accès à la base de données
:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=auth_api
    DB_USERNAME=root
    DB_PASSWORD=

Lancez ensuite les migrations pour créer les tables :

``` bash
php artisan migrate
```

*(Note : Si vous utilisez Docker avec Laravel Sail, vous pouvez
simplement lancer `./vendor/bin/sail up -d` puis
`./vendor/bin/sail artisan migrate`).*

------------------------------------------------------------------------

## 📚 Documentation de l'API

L'API est intégralement documentée via une collection Postman. Un
développeur n'ayant pas lu le code peut tester l'ensemble des routes
uniquement grâce à ce fichier.

### Comment utiliser la documentation :

1.  Téléchargez le fichier de collection situé à la racine du projet :\
    `Docs/Auth_API.postman_collection.json`

2.  Ouvrez **Postman**, cliquez sur **Import** (en haut à gauche) et
    sélectionnez le fichier JSON.

3.  Vous retrouverez toutes les requêtes préconfigurées avec :

    -   Les **Headers** (`Accept: application/json`)
    -   Les **Body d'exemple**
    -   Les **descriptions des réponses HTTP**

------------------------------------------------------------------------

## 🔐 Authentification (Bearer Token)

L'API utilise un système de token pour sécuriser les routes privées.

1.  Utilisez la route **POST /api/login** avec des identifiants valides.
2.  Récupérez le **token** dans la réponse JSON.
3.  Pour toutes les routes protégées, incluez ce token dans l'en-tête
    HTTP :

```{=html}
<!-- -->
```
    Authorization: Bearer <votre_token>

------------------------------------------------------------------------

## 🛣️ Liste des Routes (Endpoints)

### Authentification (Publique)

  Méthode   Route           Description                          Statut Succès
  --------- --------------- ------------------------------------ ---------------
  POST      /api/register   Création d'un nouveau compte         201 Created
  POST      /api/login      Connexion et récupération du token   200 OK

### Gestion du Profil (Protégée 🔒)

Si le token est absent ou invalide, l'API renvoie **401 Unauthorized**.

  Méthode   Route              Description                           Statut Succès
  --------- ------------------ ------------------------------------- ---------------
  GET       /api/me            Consulter ses propres informations    200 OK
  PUT       /api/me            Modifier son nom ou son email         200 OK
  PUT       /api/me/password   Changer son mot de passe              200 OK
  DELETE    /api/me            Supprimer définitivement son compte   200 OK
  POST      /api/logout        Se déconnecter (invalide le token)    200 OK

------------------------------------------------------------------------

## 🧪 Scénario de Test Recommandé

Pour vérifier le bon fonctionnement de l'API, suivez ce flux logique
dans Postman :

1.  Créez un compte via **/api/register**.
2.  Connectez-vous avec **/api/login** pour obtenir un token.
3.  Essayez **GET /api/me** sans token pour vérifier que l'accès est
    refusé (**401**).
4.  Refaites **GET /api/me** avec le token dans le header
    **Authorization** (**200**).
5.  Modifiez vos informations via **PUT /api/me**.
6.  Modifiez votre mot de passe via **PUT /api/me/password** (testez
    avec un mauvais mot de passe actuel pour vérifier l'erreur **422**).
7.  Déconnectez-vous via **POST /api/logout**.
8.  Tentez d'accéder à **/api/me** avec l'ancien token (doit échouer).

------------------------------------------------------------------------

## ✍️ Auteur

**Oussama Ait Youss**
