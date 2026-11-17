# GitHub et hébergement

## 1. Créer le dépôt après validation

Installer Git pour Windows si nécessaire. Créer un dépôt GitHub vide, sans README
initial. Ne pas activer de publication automatique. Dans le dossier du projet :

```powershell
Set-Location C:\wamp64\www\tp_eb
git init -b main
git check-ignore config/database.php backups/publication-20261117-115730/before.sql
git check-ignore uploads/product_69db64e4e37667.15836172.jpeg
git check-ignore assets/demo/glasses-1.svg database/demo.sql config/database.production.php uploads/.htaccess
# La dernière commande ne doit afficher aucun chemin : ces fichiers sont publiables.
git add .
git status --short
git diff --cached --stat
git diff --cached
```

Vérifier qu'aucun fichier privé ou photo locale n'est indexé. Contrôler les cinq SVG,
`database/demo.sql`, les `.htaccess`, `.env.example` et les configurations sans secrets.
Après validation seulement :

```powershell
git commit -m "Prepare La Choperie 93 public demonstration"
git remote add origin https://github.com/VOTRE_COMPTE/la-choperie-93.git
git push -u origin main
```

Ne pas utiliser `git add -f` pour contourner les exclusions. Authentifier Git selon
les outils GitHub, sans écrire de jeton dans une commande ou dans l'URL du dépôt.
Référence : https://docs.github.com/en/migrations/importing-source-code/using-the-command-line-to-import-source-code/adding-locally-hosted-code-to-github

## 2. Préparer une recette protégée

Choisir un hébergement Apache 2.4 avec une version PHP 8.x encore maintenue,
`pdo_mysql`, MySQL 8.x, HTTPS et variables d'environnement accessibles à PHP.
Les `.htaccess` demandent les modules rewrite et authz_core et des droits
AllowOverride compatibles. Si l'hébergeur ignore ces règles, faire appliquer les
mêmes restrictions par sa configuration avant tout déploiement. Nginx requiert
une configuration équivalente : ne pas y copier simplement les `.htaccess`.

Activer une authentification de recette dans le panneau de l'hébergeur avant
le transfert. Les identifiants de cette protection ne doivent pas être versionnés.
Cela laisse toutes les fonctionnalités disponibles aux personnes autorisées,
sans exposer l'application aux visiteurs anonymes pendant le durcissement.

## 3. Déployer les seuls fichiers nécessaires

Transférer `index.php`, `.htaccess`, `config/` SANS `database.php`, `controllers/`,
`models/`, `views/`, `assets/css/`, `assets/demo/`, et `uploads/.htaccess`.
Ne transférer ni `backups/`, ni `.git/`, ni les photos locales, ni les rapports.
Le dossier uploads doit être inscriptible par PHP, sans permissions 777.
Les sources et configurations ne doivent pas être inscriptibles par PHP.

Créer une base vide distincte de la base locale et importer `database/demo.sql`
avec phpMyAdmin ou le client MySQL. Le fichier n'est pas à laisser dans l'espace web.
L'export contient cinq produits, trois catégories et zéro compte utilisateur.
Ne jamais importer une sauvegarde privée pour cette démonstration publique.

## 4. Configurer le mode production

Configurer les variables dans le panneau de l'hébergeur / PHP-FPM, sans les
publier dans Git ni les afficher dans une page PHP :

```text
APP_ENV=production
DB_HOST=<hôte MySQL fourni par l'hébergeur>
DB_PORT=3306
DB_NAME=<base de démonstration>
DB_USER=<utilisateur dédié>
DB_PASSWORD=<mot de passe fort et unique>
```

`.env.example` documente les noms ; le copier en `.env` ne charge pas les variables.
Si elles ne sont pas prises en charge, choisir une configuration serveur adaptée
avant de publier. N'utiliser ni root ni un mot de passe vide. Limiter les droits
SQL de l'utilisateur d'exécution à SELECT, INSERT et UPDATE sur la base de démo ;
l'import initial peut utiliser un compte d'administration séparé.

Activer la redirection HTTPS dans l'hébergement, y compris derrière son proxy.
Le mode production impose des cookies Secure, HttpOnly et SameSite=Lax : le panier
et la connexion doivent donc être utilisés en HTTPS. Il masque les erreurs PHP,
active leur journalisation et ajoute des en-têtes de sécurité. Régler également
`display_errors=Off`, `display_startup_errors=Off`, `log_errors=On` et
`expose_php=Off` dans la configuration PHP serveur ; stocker les logs hors du web.
Pour une base distante, configurer une liaison MySQL privée ou TLS selon l'hébergeur.
Ne pas supposer que ce code configure à lui seul le chiffrement MySQL.

## 5. Vérifier puis autoriser l'accès public

- HTTPS valide et redirection HTTP vers HTTPS.
- Accueil et cinq détails : cinq illustrations SVG HTTP 200.
- Recherche Cartier : cinq résultats ; recherche ciblée : un résultat.
- Panier : ajout, cumul, total et retrait ; fonctionnement après navigation.
- Création de comptes fictifs et connexion sur la base distante séparée.
- Ajout vendeur et gestion d'une image invalide sur cette base de recette.
- Cookies de session Secure/HttpOnly/SameSite, erreurs génériques.
- Accès à `/config/database.production.php`, `/database/demo.sql`, `/backups/`,
  `/.env` et `/.git/config` refusés (403 ou 404), même en sous-dossier.
- Accès à un fichier script dans uploads refusé, et index de dossiers désactivés.

Les points bloquants de l'audit PUBLICATION.md doivent être corrigés et retestés
avant de retirer la protection de recette. Ne pas considérer le succès des seuls
tests HTTP comme une validation de sécurité. Conserver une sauvegarde privée hors
de l'espace web et définir une procédure de restauration.

Documentation Apache : https://httpd.apache.org/docs/2.4/en/howto/htaccess.html
Cookies PHP : https://www.php.net/manual/en/function.session-set-cookie-params.php
