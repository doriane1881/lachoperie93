# Images et droits de publication

Les photos locales sont conservées, mais exclues de Git tant que leurs droits
de republication ne sont pas établis. Un clone inclut désormais cinq illustrations
originales dans `assets/demo/`, référencées par `database/demo.sql`. Il peut donc
afficher les cinq produits sans photo tierce. La base locale est inchangée.

Le propriétaire du projet indique disposer d'autorisations. Leur portée exacte
(fichiers couverts, titulaire, diffusion GitHub et site public, attribution) reste
à préciser. Aucun justificatif privé ne doit être ajouté au dépôt.

| Produit | Chemin attendu | Statut |
| --- | --- | --- |
| 1 | uploads/product_69db64e4e37667.15836172.jpeg | Provenance et licence à documenter |
| 2 | uploads/product_69db6554810bb4.01300210.jpeg | Provenance et licence à documenter |
| 3 | uploads/product_69db65c1a189e8.32604597.jpeg | Provenance et licence à documenter |
| 4 | uploads/product_69df66ca4f8266.79987377.jpeg | Provenance et licence à documenter |
| 5 | uploads/Capture d’écran_17-11-2026_114217_www.mrporter.com.jpeg | Capture MR PORTER, autorisation à obtenir |

Pour la version publique, chaque ID 1 à 5 utilise respectivement
`assets/demo/glasses-1.svg` à `assets/demo/glasses-5.svg`. Ces dessins génériques
sans marque ont été créés en code pour cette démonstration ; leur permission
de redistribution avec le projet est dans `assets/demo/NOTICE.md`. Aucune ressource
externe n'entre dans leur composition. Ils sont signalés comme illustrations,
pas comme photos fidèles des articles. Les noms et les prix restent ceux du
catalogue pédagogique ; aucune affiliation à une marque n'est revendiquée.

Les conditions de MR PORTER ne confèrent pas de droit de republication des photos :
https://www.mrporter.com/en-us/content/help/terms-and-conditions/
Le contexte scolaire ne constitue pas une preuve d'autorisation.

Avant de publier les PHOTOS, obtenir une autorisation couvrant GitHub et le site public,
ou fournir ses propres photos / des visuels sous licence compatible. Documenter
pour chaque fichier la source, l'auteur, la licence, la preuve et l'attribution.
Lever ensuite l'exclusion Git uniquement pour les fichiers autorisés et vérifier
les chemins du SQL de démonstration. Aucun remplacement automatique n'est effectué.
Les deux autres images locales, non utilisées par le catalogue, restent exclues.
