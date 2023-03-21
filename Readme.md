# Quai Antique

![Page d'accueil](public/build/images/home.png)
Quai Antique est un site effectué dans le cadre d'un passage à un examen (ECF).

---

## **LE PROJET RESTAURANT**

---

#### Le projet consiste en la création d'un site web pour un restaurant. Les fonctionnalités principales sont les suivantes :

### **Connexion :**

#### Les administrateurs et les clients pourront se connecter en utilisant le même formulaire avec leur adresse e-mail et un mot de passe sécurisé.

### **Galerie d'images :**

#### Les administrateurs peuvent ajouter, modifier ou supprimer des photos de plats. Chaque photo aura un titre visible sur la page d'accueil et un bouton de réservation sera également ajouté à cette page.

### **Carte du restaurant :**

#### Les plats seront classés en différentes catégories avec un titre, une description et un prix.

### **Menus :**

#### Les menus seront créés avec des titres et des formules comprenant une description et un prix.

### **Horaires d'ouverture :**

#### Les horaires d'ouverture du restaurant seront affichés sur toutes les pages du site et pourront être modifiés par les administrateurs.

### **Réservation de table :**

#### Les visiteurs pourront réserver une table en spécifiant le nombre de couverts, la date et l'heure prévue, ainsi que les allergies éventuelles. Le système permettra de vérifier la disponibilité des places en temps réel, avec un seuil de convives maximum fixé par les administrateurs.

### **Allergies :**

#### Les visiteurs pourront signaler les allergies lors de la réservation d'une table et pourront également créer un compte client pour gagner du temps lors de la saisie des informations.

#### Ces fonctionnalités sont destinées à améliorer l'expérience utilisateur et à faciliter la gestion des informations pour les administrateurs.

---

## **Pré-requis** :

---

- PHP >= [8.1][php]
- Symfony >= [6.1][cli]
- Database => ([MYSQL], [PostgreSQL])
- [Composer]
- [Nodejs]
- [NPM]

---

## **Installation en local** :

---

Clonez le dépôt Git du projet en utilisant la commande suivante dans votre terminal ou votre invite de commande :

```
git clone https://github.com/Phalente/Quai_Antique.git
```

Une fois le dépôt cloné, accédez au dossier du projet en utilisant la commande :

```
cd Quai_Antique
```

Puis commencer à installer les dépendances de Composer et npm du projet

```
composer install
npm install
```

Créez un fichier `.env.dev.local` à la racine du projet et définissez votre variable d'environnement.

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_la_database?serverVersion=8&charset=utf8mb4"
```

Faites la commande suivante afin de créer la database puis effectuer votre migration en base de donnée.

```
symfony console doctrine:database:create
symfony console doctrine:migration:migrate
```

Vous avez la possibilité de charger des fixtures mis à votre dispositions en utilisant la commande : `php bin/console doctrine:fixtures:load`

Pour les modifier, vous trouverez les fixtures dans le fichier :

`src/DataFixtures/AppFixture.php`

Félicitations ! Vous pouvez enfin démarrer Symfony avec la commande :

```
symfony server:start
```

Vous avez également la possibilité de remplir la base de donnée avec le compte admin généré depuis le chargement des fixtures.

### **Compte Admin :**

---

- Email d'authentification : `admin@quaiantique.fr`
- Mot de passe : `password`

Ce dernier vous permettra de remplir les tables Allergy, RestaurantHours et category si vous n'avez pas les fixtures.

`http://127.0.0.1:8000/allergie`

`http://127.0.0.1:8000/addhoraire`

`http://127.0.0.1:8000/categorie`

---

### **Compte Client :**

Pour vous connecter en tant que Client vous pouvez vous inscrire et créer un compte avec une adresse e-mail fictive, ou, vous pouvez selectionner une adresse e-mail d'un user généré par les fixtures.

Le mot de passe utilisé sera : `password`

---

Pour finir, vous pouvez fermer votre server avec la simple commande

```
symfony server:stop
```

## Passer une agréable navigation sur le site de Quai Antique.

---

## **Fabriqué avec :**

---

Ce projet est développé avec :

- [Symfony 6.1][cli]

Bundle utilisé :

- EasyAdmin => [Documentation EasyAdmin][easyadmin]
- FakerPHP => [Documentation FakerPHP][fakerphp]
- DoctrineFixture => [Documentation DoctrineFixture][doctrinefixture]
- WebpackEncore => [Documentation WebpackEncore][webpackencore]
- VichUploader => [Documentation VichUploader][vichuploader]

---

## **Auteur :**

### _Mr Phalente Robyn_

[php]: https://www.php.net/downloads.php
[cli]: https://symfony.com/download
[mysql]: https://www.mysql.com/fr/downloads/
[postgresql]: https://www.postgresql.org/download/
[composer]: https://getcomposer.org/download/
[nodejs]: https://nodejs.org/fr/download
[npm]: https://docs.npmjs.com/downloading-and-installing-node-js-and-npm
[easyadmin]: https://symfony.com/bundles/EasyAdminBundle/current/index.html
[fakerphp]: https://fakerphp.github.io/
[doctrinefixture]: https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html
[vichuploader]: https://github.com/dustin10/VichUploaderBundle/blob/master/docs/index.md
[webpackencore]: https://symfony.com/doc/current/frontend.html
