# Shadow c'est quoi ?
Un site web single page permettant de filtrer des produits à la manière d'un site e-commerce. J'ai commencé ce projet en 2019 dans le but d'apprendre PHP sur mon temps libre.

![presentation](/images/presentation.gif)

## Fonctionalités
Le site permet d’afficher des produits en fonction d’un certain nombre de filtres sélectionnés, à la manière d’un site e-commerce. Par défaut, la totalité des produits présents dans la base de données sont affichés à l’utilisateur, soit 30 produits. Cependant à l’aide du panneau des filtres, les propriétés que doivent obligatoirement présenter les objets affichés, peuvent être sélectionnées au moyen des cases à cocher. A noter qu’en fonction du nombre de produits à afficher, ces derniers peuvent être répartis sur plusieurs pages. Une page étant composée de maximum 12 produits.

- A l'aide d’une liste déroulante prévue à cet effet, la possibilité est également donnée de changer l’ordre dans lequel sont affichés les produits. Par défaut les produits sont triés par ordre croissant de prix mais le tri peut aussi s'effectuer par date d’apparition dans le catalogue ou alors du plus grand au plus petit rabais accordé.

- Il est également possible de rechercher un produit contenant une série de mots-clés présent dans le nom du produit. Les filtres seront alors ignorés. La casse n’est pas prise en compte dans la recherche, de même que les mots de 2 lettres ou moins. Certains autres mots particuliers ne sont également pas pris en compte dans la recherche, tels que : les, des, caractères d’espace, etc. 

- Au moyen du bouton prévu à cet effet, il est possible de réinitialiser tous les filtres sélectionnés. A noter que les filtres appliqués par l’utilisateur sont stockés dans des variables de session et sont donc mémorisés aussi longtemps que la session reste active.

## Organisation du projet
Pour ce projet, j'ai fais le choix d’essayer d’implémenter une architecture MVC. Cela peut sembler un peu exagéré pour un si petit projet, néanmoins  l’architecture MVC à l'avantage de permettre une division compréhensible des différentes tâches de l’application, une meilleure maintenabilité du code ainsi que la possibilité de pouvoir facilement expandre le projet. Ce choix est également motivé par la volonté d’apprendre Ce design pattern.

### Les répertoires
En accord avec le design pattern choisi, le code est donc réparti dans 3 dossiers, respectivement models, views, controllers.
- Les fichiers Models gèrent les interactions avec la base de données.
- Les fichiers Views, se composent essentiellement de la structure HTML du site, accompagnés de quelques éléments logiques.
- Enfin les fichiers Controllers font le pont entre les Models et les Views requis. Tous les fichiers Models héritent de la classe `ModelCommon`. Cette classe stock sous forme de méthodes statiques des fonctionnalités pouvant être utiles aux fichiers Models, dont notamment les accès à la base de données.

### Fichier Router
C’est le fichier Router qui choisit quels Controllers charger en fonction du contenu de la variable `$_GET`. Cependant comme le site ne dispose que d’une seule page, c’est toujours le même fichier Controllers qui est chargé, à l’exception des requêtes Ajax permettant de rafraîchir dynamiquement certains composants du site, lesquelles sont traitées côté serveur par un fichier Controllers distinct.


### Autoloader
Dans le but de simplifier la gestion des « require » afin d’utiliser les classes, j’ai créé une classe servant d’autoloader permettant de requérir automatiquement les classes nécessaires au moment de leur instanciation dans le code. En vue de profiter pleinement de cette fonctionnalité, j’ai stocké chaque classe dans un namespace, au nom identique au dossier, dans laquelle elle est physiquement stockée.

### CSS
Côté CSS le site est prévu pour être responsive. Celui-ci a été codé au moyen de la méthodologie BEM ainsi que du préprocesseur SASS, plus précisément de sa variante SCSS. Ceci permet notamment de profiter des fichiers partiels de manière à compiler le tout dans un seul fichier CSS.

## Installation

 Les étapes suivantes peuvent être réalisées dans n’importe quel ordre mais toutes sont essentielles au fonctionnement de l’application.

- Importer le contenu du fichier `db/shadowdb.sql` dans la base de données souhaitée, soit au moyen de l’outil en ligne de commande ou alors directement depuis un outil muni d’une interface graphique comme par exemple PhpMyAdmin qui propose une option pour importer des tables depuis un fichier externe.
- Uploader l’application sur le serveur au moyen d’un outil de transfert SFTP tel que Filezilla ou bien utiliser directement la commande SFTP en ligne de commande.
- Modifier les informations de connexion pour se connecter à la base de données du serveur. Les informations susceptibles d’être modifiées sont les suivantes : __nom de la base de données__, __identifiants__, __mot de passe__, __type de base de données__. Ces informations sont modifiables directement dans le dossier du projet  dans `Models/ModelCommon.php` dans la fonction `setBdd()`.
