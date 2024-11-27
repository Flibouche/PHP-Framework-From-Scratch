
# :fr: Framework PHP "from scratch" - Basé sur le tutoriel Quick Programming  

## Description  

Ce projet est un **framework PHP from scratch**, réalisé grâce aux tutoriels de la chaîne YouTube [Quick Programming](https://www.youtube.com/@QuickProgramming). L'objectif était de créer un framework léger et modulaire, en appliquant les principes de la programmation orientée objet (POO) et du modèle MVC (Model-View-Controller).  

## Structure du Projet  

Voici une description des principaux dossiers et fichiers :  

### `app/`  

Le répertoire principal du framework, contenant la logique de l'application.  

- **`controllers/`** : Contient les contrôleurs qui gèrent les requêtes et orchestrent les interactions entre les modèles et les vues.  
  - Exemples : `Home.php`, `Login.php`, `Register.php`.  

- **`core/`** : Regroupe les fichiers essentiels du framework.  
  - `App.php` : Point d'entrée pour initialiser l'application.  
  - `Controller.php` : Classe de base pour les contrôleurs.  
  - `Database.php` : Gestion de la connexion à la base de données.  
  - `functions.php` : Fonctions globales utilitaires.  
  - `Model.php` : Classe de base pour les modèles.  

- **`models/`** : Contient les classes qui représentent les données et gèrent la logique métier.  
  - Exemples : `User.php` pour la gestion des utilisateurs, `Pager.php` pour la pagination.  

- **`thunder/`** : Un outil supplémentaire pour gérer les migrations et l'initialisation.  
  - `Migration.php` : Classe pour gérer les migrations de la base de données.  
  - `samples/` : Exemples pour créer des contrôleurs, des modèles et des migrations.  

### `views/`  

Ce répertoire est dédié aux fichiers de présentation (vues). Il contient les fichiers HTML/PHP qui affichent les données à l'utilisateur final.  

### `public/`  

Dossier public qui contient les fichiers accessibles par le navigateur.  
- `index.php` : Point d'entrée principal de l'application.  
- `.htaccess` : Configuration pour rediriger les requêtes vers `index.php`.  
- `assets/` : Dossier pour les ressources statiques comme CSS, JavaScript, et images.  

---  

## Fonctionnalités  

- **MVC** : Modèle-Contrôleur-Vue pour une séparation claire des responsabilités.  
- **Routing** : Gestion des routes pour diriger les requêtes utilisateur vers les bons contrôleurs.  
- **Base de données** : Intégration avec une classe de gestion de base de données.  
- **Migrations** : Possibilité de créer et d'exécuter des migrations pour gérer la structure de la base de données.  
- **Sessions** : Gestion des sessions utilisateur.  

## Installation  

1. Clonez le projet :  

   ```bash  
   git clone <URL_DU_REPO>  
   cd <NOM_DU_PROJET>  
   ```  

2. Configurez la connexion à la base de données dans `app/core/config.php`.  

3. Placez le dossier du projet dans un serveur compatible PHP (par exemple, Laragon, XAMPP ou WAMP).  

4. Accédez au projet via l'URL définie dans votre serveur web.  

---  

## Inspirations et Remerciements  

Un grand merci à [Quick Programming](https://www.youtube.com/@QuickProgramming) pour les explications claires et détaillées.  

---  

# :uk: PHP Framework "from scratch" - Based on Quick Programming Tutorial  

## Description  

This project is a **PHP framework from scratch**, created following tutorials from the YouTube channel [Quick Programming](https://www.youtube.com/@QuickProgramming). The goal was to build a lightweight and modular framework, applying object-oriented programming (OOP) principles and the MVC (Model-View-Controller) pattern.  

## Project Structure  

Here is a description of the main folders and files:  

### `app/`  

The main directory of the framework, containing the application logic.  

- **`controllers/`**: Contains the controllers that handle requests and orchestrate interactions between models and views.  
  - Examples: `Home.php`, `Login.php`, `Register.php`.  

- **`core/`**: Includes essential framework files.  
  - `App.php`: Entry point to initialize the application.  
  - `Controller.php`: Base class for controllers.  
  - `Database.php`: Handles database connections.  
  - `functions.php`: Global utility functions.  
  - `Model.php`: Base class for models.  

- **`models/`**: Contains classes that represent data and handle business logic.  
  - Examples: `User.php` for user management, `Pager.php` for pagination.  

- **`thunder/`**: A utility for handling migrations and initialization.  
  - `Migration.php`: Manages database migrations.  
  - `samples/` : Examples for creating controllers, models, and migrations.  

### `views/`  

This folder is dedicated to presentation files (views). It contains the HTML/PHP files that display data to the end-user.  

### `public/`  

Public folder containing files accessible by the browser.  
- `index.php`: Main entry point of the application.  
- `.htaccess`: Configuration to redirect requests to `index.php`.  
- `assets/`: Folder for static resources such as CSS, JavaScript, and images.  

---  

## Features  

- **MVC**: Model-Controller-View for a clear separation of concerns.  
- **Routing**: Route management to direct user requests to the correct controllers.  
- **Database**: Integration with a database management class.  
- **Migrations**: Ability to create and run migrations to manage database structure.  
- **Sessions**: User session management.  

## Installation  

1. Clone the project:  

   ```bash  
   git clone <REPO_URL>  
   cd <PROJECT_NAME>  
   ```  

2. Configure the database connection in `app/core/config.php`.  

3. Place the project folder on a PHP-compatible server (e.g., Laragon, XAMPP, or WAMP).  

4. Access the project via the URL defined in your web server.  

---  

## Inspirations and Thanks  

A big thank you to [Quick Programming](https://www.youtube.com/@QuickProgramming) for the clear and detailed explanations.  

---  
