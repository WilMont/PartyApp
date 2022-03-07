# PartyApp

## Présentation
PartyApp est une application qui permet aux utilisateur de créer et partager des événements en cours ou à venir.

## Outils requis
* Git
* Composer
* WAMP (ou autre système permettant de faire tourner un serveur local).
* PHP 7.4.2

## Installation
1. Installez les outils requis.
2. Clonez ce répertoire.
3. Ouvrez Powershell.
4. Placez-vous dans le dossier où vous avez cloné ce répertoire avec la commande:
>cd chemin/vers/repertoire.
5. Exécutez la commande
>composer install
6. Importez le script d'installation de la BDD dans votre MySQL.
7. Modifiez le fichier .env à la racine du projet avec les informations vers votre BDD:
>DATABASE_URL=mysql://nomUtilisateurBDD:mdpBDD@127.0.0.1:3306/nomBDD
8. Supprimez tous les fichiers migration dans src/Migrations.
9. Exécutez les commandes
>php bin/console make:migration
>php bin/console doctrine:migrations:migrate
10. Lancez le serveur avec la commande
>php bin/console server:run
