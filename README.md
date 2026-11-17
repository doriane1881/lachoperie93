# La Choperie 93

Boutique pédagogique PHP/MySQL réalisée dans le cadre du BTS SIO, option SLAM.
Elle présente un catalogue de cinq lunettes dans une interface noire et dorée.
Ce projet est une démonstration : aucun paiement ni passage de commande n'est implémenté.

## Fonctionnalités

- Catalogue, fiches produit et recherche par nom.
- Panier en session : ajout, cumul des quantités, retrait et calcul des totaux.
- Inscription, connexion, déconnexion et profil utilisateur.
- Ajout de produits avec image pour le rôle vendeur.
- Barre de recherche adaptable aux petits écrans et soumission avec Entrée.

## Technologies et organisation

PHP sans framework, PDO MySQL, MySQL, HTML et CSS. Architecture MVC simple :
`index.php` distribue les requêtes aux `controllers/`, qui utilisent les
`models/` et les `views/`. Les ressources sont dans `assets/` et `uploads/`.
Les URL d'images et du CSS sont adaptées à une installation en sous-dossier.

## Installation locale

Prérequis : PHP 8.0 ou supérieur avec `pdo_mysql`, MySQL 8.x et un serveur web
PHP (WampServer convient). Le projet n'utilise ni Composer ni npm.

1. Copier ou cloner le projet dans un dossier web, par exemple `www/tp_eb`.
2. Créer une base vide `lachoperie93_demo` en UTF-8 et un utilisateur MySQL dédié.
3. Importer `database/demo.sql` dans cette base vide avec phpMyAdmin, ou :

   ```sh
   mysql -u MYSQL_USER -p lachoperie93_demo < database/demo.sql
   ```

4. Copier `config/database.example.php` en `config/database.php` et renseigner
   hôte, nom de base, utilisateur et mot de passe. Ce fichier local est ignoré.
5. Conserver les cinq illustrations originales de `assets/demo/`, incluses dans
   le dépôt et référencées par le SQL de démonstration. Aucune photo tierce n'est
   nécessaire au fonctionnement d'un clone.
6. Démarrer Apache et MySQL, puis ouvrir `http://localhost/tp_eb/`.

L'import ne sélectionne pas de base et ne supprime aucune table. Utiliser une
base vide distincte de la base locale existante. Il contient les trois structures,
les trois catégories et cinq produits de démonstration. La table `users` est vide :
aucune adresse réelle, aucun compte ni hash de mot de passe n'est exporté.
Créer des comptes de démonstration via l'inscription, avec des données fictives.

Le dossier `uploads/` doit être accessible en écriture au serveur pour les ajouts.
Ne pas utiliser des permissions universelles en production.

## État de préparation à la publication

La version locale conserve ses photos. Le SQL de démonstration utilise cinq
illustrations SVG originales incluses et réutilisables avec le projet.
Les droits sur les photos locales ne sont pas considérés comme vérifiés : elles
restent exclues du dépôt ; voir [docs/IMAGES.md](docs/IMAGES.md).
Les sauvegardes, secrets et rapports locaux sont volontairement exclus.
Aucune licence globale n'est attribuée au code. La permission des cinq SVG est
décrite dans [assets/demo/NOTICE.md](assets/demo/NOTICE.md).

## Hébergement futur

Utiliser un hébergement Apache 2.4 exécutant PHP avec MySQL : GitHub Pages ne
peut pas exécuter cette application. Le guide [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)
détaille la configuration d'environnement, HTTPS, les permissions et les contrôles.
`APP_ENV=production` active `config/database.production.php` : aucun fichier
`config/database.php` ni identifiant local ne doit être transféré sur l'hébergement.
Sans cette variable, le projet utilise la configuration locale privée existante.
Un fichier `.env` n'est pas automatiquement chargé.

Cette application reste pédagogique. Des points de sécurité restent bloquants
pour une ouverture sans restriction ; voir [docs/PUBLICATION.md](docs/PUBLICATION.md).
En attendant, utiliser un environnement de recette protégé par authentification
au niveau de l'hébergeur. Aucune publication n'a été effectuée automatiquement.

## Vérification manuelle

Vérifier l'accueil (cinq produits), chaque détail et ses images, une recherche
« Cartier » (cinq résultats) et « Model 5 » (un résultat). Tester le panier dans
une session privée : ajout, quantité, total, retrait. Sur une base de démo séparée,
tester l'inscription, la connexion et l'ajout vendeur sans utiliser de comptes réels.
