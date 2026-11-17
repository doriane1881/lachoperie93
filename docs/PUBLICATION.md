# Audit avant publication

## Git et confidentialité

Aucun `.git` présent dans le projet lors de l'audit. La commande Git n'est pas
disponible dans le PATH de la session. Aucun dépôt n'a été initialisé ou publié.
Installer Git pour Windows si nécessaire, puis rouvrir le terminal.

Le fichier local `config/database.php` contient la configuration Wamp (root,
mot de passe vide). Il est conservé pour le fonctionnement local, mais exclu
par `.gitignore`. Ne pas utiliser ce compte sur un hébergement.
Les sauvegardes SQL contiennent potentiellement des comptes et des hashes de
mots de passe : tout `backups/` est exclu, ainsi que les SQL hors `database/demo.sql`.
Aucun autre secret codé en dur n'a été repéré dans les sources inspectées.
Cela ne dispense pas de contrôler les fichiers réellement indexés avant un commit.

Les photos restent exclues faute de preuve de droits (voir IMAGES.md).
PHP, CSS, exemples de configuration, cinq SVG de `assets/demo/`, protections
Apache et SQL de démo doivent rester versionnés. Les chemins d'images du SQL
public ne pointent plus vers les photos locales. Voir DEPLOYMENT.md.

## Durcissement de configuration appliqué

- `APP_ENV=production` sélectionne la connexion MySQL par variables d'environnement,
  sans dépendre du fichier local ignoré. Variables obligatoires contrôlées, PDO
  avec requêtes préparées natives et erreur publique générique HTTP 503.
- Mode production : erreurs masquées, journalisation, cookies Secure/HttpOnly/
  SameSite=Lax, mode strict de session et en-têtes de sécurité.
- Apache : accès web aux répertoires internes, fichiers cachés et exports refusé,
  indexation désactivée. Dans uploads, seules les extensions image autorisées
  sont servies, avec refus explicite des noms contenant une extension de script.
- Aucun secret ajouté ; le fichier Wamp existant et les photos restent privés.

Ces règles ne remplacent pas la configuration serveur : vérifier AllowOverride,
HTTPS, droits système, logs et protections sur l'hébergement. Elles ne protègent
pas les anciens exports contre un utilisateur ayant accès directement au disque.

## Limites applicatives constatées

- L'inscription permet de choisir le rôle vendeur. Ce comportement pédagogique
  doit être revu avant une ouverture au public.
- Absence de protection CSRF ; ajout/retrait du panier et déconnexion via GET.
- Pas de limitation des tentatives de connexion ni de régénération de session
  après authentification dans le contrôleur actuel.
- Les images téléversées sont filtrées par extension et taille, sans validation
  du contenu MIME. L'exécution de scripts dans uploads doit être interdite.
- Certains chemins d'erreur de téléversement pointent vers une vue inexistante
  `views/product/add_product.php` au lieu de `views/user/add_product.php`.
- La configuration locale affiche les détails des exceptions de connexion.
  L'exemple fourni utilise un message public générique.
- Les tables locales sont MyISAM : pas de transactions ni de clés étrangères
  effectives. Le SQL de démonstration préserve cette structure.

Ces limites applicatives restent présentes ; le durcissement de configuration
ci-dessus ne les corrige pas. Le choix du rôle vendeur, les actions sans CSRF,
la validation de contenu des téléversements et les chemins d'erreur sont des
points bloquants pour une ouverture publique sans restriction. Le renouvellement
de session après connexion et une limitation des tentatives restent à ajouter.
La configuration de production masque désormais les erreurs de connexion ; la
configuration locale historique est préservée.
Toutes les fonctionnalités sont conservées. En attendant ces corrections,
déployer uniquement en recette protégée par authentification serveur, puis
effectuer les tests d'écriture sur une base de démo séparée.
Les contrôles HTTP locaux ne constituent pas une validation de sécurité production.

## Résultats locaux de cette préparation

- Syntaxe PHP : 22 fichiers vérifiés sans erreur après ajout du mode production.
- Accueil HTTP 200, cinq produits et cinq images HTTP 200.
- Cinq détails HTTP 200 avec leurs images HTTP 200.
- Recherche Cartier : cinq résultats.
- Formulaires de connexion et inscription HTTP 200 ; aucun compte créé.
- Panier : ajout, cumul de quantité et retrait dans une session isolée.
- Feuille de style HTTP 200 ; aucun fichier de présentation modifié.
- Exports SQL complets avant/après identiques par SHA-256 : base inchangée.
- Export de démonstration construit en lecture seule avec des colonnes explicites,
  sans données utilisateurs ni historique d'auto-incrémentation. Il n'a pas été
  importé : aucun test d'import n'a été exécuté afin de ne créer ou modifier de base.
- Les règles `.gitignore` sont préparées ; leur contrôle effectif par
  `git check-ignore` reste à exécuter une fois Git disponible.
- Cinq SVG : XML valide et HTTP 200 sous WampServer. Les vues publiques ont été
  rendues en PHP avec substitution des chemins en mémoire (accueil, recherche,
  cinq détails), sans importer le SQL ni modifier les données locales.
- Options runtime de production vérifiées : cookies Secure, HttpOnly, SameSite=Lax,
  mode strict et erreurs masquées. Configuration MySQL manquante : message générique,
  sans détails PDO. Aucune connexion MySQL de production distante n'a été testée.
- Protections Apache vérifiées : HTTP 403 pour config, export SQL, backups,
  `.env` et `.git/config`. Les mêmes contrôles devront être répétés sur l'hébergeur.
- Pas de test visuel navigateur réalisé pour ces nouveaux SVG : le XML, les URL
  et le HTML rendu ont été contrôlés, sans capture du rendu final hébergé.

La configuration locale existante est conservée. Aucun fichier de Portfolio_Doria
n'a été consulté ou modifié. Aucun commit, push ou déploiement n'a été effectué.

## Commandes après vérification des droits et fichiers

Exécuter uniquement depuis le dossier du projet. Ces commandes sont fournies,
pas exécutées. Créer sur GitHub un dépôt vide `la-choperie-93` sans README initial.

```powershell
Set-Location C:\wamp64\www\tp_eb
git init -b main
git check-ignore config/database.php backups/catalogue-20261117-112645/lachoperie93.sql
git add .
git status --short
git diff --cached --stat
git diff --cached
# Vérifier : aucun secret, compte réel, sauvegarde ou photo sans autorisation.
git commit -m "Prepare La Choperie 93 demonstration project"
git remote add origin https://github.com/VOTRE_COMPTE/la-choperie-93.git
git push -u origin main
```

Ne pas forcer l'ajout des fichiers ignorés. Si un secret a déjà été publié,
l'ignorer ensuite ne le retire pas de l'historique : il faut le révoquer et
traiter l'historique avant de poursuivre.
