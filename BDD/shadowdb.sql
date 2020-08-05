-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 25 juil. 2020 à 21:08
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shadowdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `couleurs`
--

CREATE TABLE `couleurs` (
  `id_couleur` int(10) NOT NULL,
  `cou_nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `couleurs`
--

INSERT INTO `couleurs` (`id_couleur`, `cou_nom`) VALUES
(1, 'Noir'),
(2, 'Blanc'),
(3, 'Vert'),
(4, 'Rouge'),
(5, 'Dorré'),
(6, 'Gris'),
(7, 'Marron'),
(8, 'Argenté'),
(9, 'Orange');

-- --------------------------------------------------------

--
-- Structure de la table `echelle_prix`
--

CREATE TABLE `echelle_prix` (
  `id_echelle_prix` int(11) NOT NULL,
  `ech_nom` varchar(30) NOT NULL,
  `ech_min` decimal(7,2) NOT NULL DEFAULT '0.00',
  `ech_max` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `echelle_prix`
--

INSERT INTO `echelle_prix` (`id_echelle_prix`, `ech_nom`, `ech_min`, `ech_max`) VALUES
(1, 'Tous', '0.00', '99999.00'),
(2, 'Moins de 20 CHF', '0.00', '19.99'),
(3, '20 CHF - 50 CHF', '20.00', '49.99'),
(4, '50 CHF - 100 CHF', '50.00', '99.99'),
(5, '100 CHF - 150 CHF', '100.00', '149.99'),
(6, '150 CHF - 200 CHF', '150.00', '199.99'),
(7, '200 CHF - 250', '200.00', '249.99'),
(8, '250 CHF ou plus', '250.00', '99999.00');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `idx_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_image`, `idx_produit`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 3),
(7, 3),
(8, 3),
(9, 4),
(10, 4),
(11, 5),
(12, 5),
(13, 5),
(14, 6),
(15, 7),
(16, 7),
(17, 7),
(18, 8),
(19, 8),
(20, 8),
(21, 9),
(22, 10),
(23, 10),
(24, 11),
(25, 11),
(26, 12),
(27, 12),
(28, 12),
(29, 13),
(30, 13),
(31, 13),
(32, 14),
(33, 15),
(34, 15),
(35, 15),
(36, 16),
(37, 16),
(38, 17),
(39, 17),
(40, 17),
(41, 18),
(42, 18),
(43, 18),
(44, 18),
(45, 19),
(46, 20),
(47, 20),
(48, 21),
(49, 21),
(50, 21),
(51, 22),
(52, 23),
(53, 23),
(54, 24),
(55, 24),
(56, 25),
(57, 26),
(58, 27),
(59, 28),
(60, 29),
(61, 30);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id_marque` int(11) NOT NULL,
  `mar_nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id_marque`, `mar_nom`) VALUES
(1, 'FLOS'),
(2, 'MARKSLOJD'),
(3, 'KERIA'),
(4, 'PAUL NEUHAUS'),
(5, 'BRILLIANT'),
(6, 'ALUMINOR'),
(7, 'COREP'),
(8, 'NAVE'),
(9, 'LUCIDE'),
(10, 'XANLITE'),
(11, 'GLOBO'),
(12, 'IDEAL LUX'),
(13, 'LIV'),
(14, 'EGLO');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `id_matiere` int(11) NOT NULL,
  `mat_nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id_matiere`, `mat_nom`) VALUES
(1, 'Aluminium'),
(2, 'Tissu'),
(3, 'Métal'),
(4, 'PVC'),
(5, 'Bois'),
(6, 'Verre');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(10) NOT NULL,
  `pro_nom` varchar(70) NOT NULL,
  `pro_description` varchar(2000) NOT NULL,
  `pro_dimension` varchar(40) NOT NULL,
  `pro_poids` varchar(20) NOT NULL,
  `pro_quantite` int(10) NOT NULL,
  `pro_prix` decimal(5,2) NOT NULL,
  `pro_rabais` int(2) NOT NULL DEFAULT '0',
  `pro_date` date NOT NULL,
  `idx_type` int(11) NOT NULL,
  `idx_marque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `pro_nom`, `pro_description`, `pro_dimension`, `pro_poids`, `pro_quantite`, `pro_prix`, `pro_rabais`, `pro_date`, `idx_type`, `idx_marque`) VALUES
(1, 'Applique Wan', 'Un minimalisme très design : Wan est une petite coupole en aluminium disponible en quatre coloris différents : finition chromé, blanc brillant, vert brillant et noir brillant. Applique murale ou suspension à lumière directe, elle est munie d\'un écran anti-éblouissement. Présentée en composition alignée, elle propose une forte valeur décorative et caractérise la pièce de sa lumière originale. Existe également dans une version suspension.', ' Ø 11.5 cm - P 8.9 cm', '0.53 kg', 99, '131.90', 0, '2020-06-09', 4, 1),
(2, 'Suspension JAMIE avec abat-jour violine', 'La suspension JAMIE est parfaite pour les personnes qui recherchent un style baroque mais qui souhaitent tout de même conserver une touche moderne. Conçu en métal noir, ce luminaire possède 3 sources lumineuses en forme de chandelier cachées par un bel abat-jour en tissu couleur violine. JAMIE arbore donc un look vintage qui se mariera sans aucun doute avec votre aménagement intérieur et votre décoration actuelle. Cette suspension trouvera sa place dans votre salon pour créer une ambiance lumineuse conviviale, au-dessus de votre table à manger pour illuminer vos moments de partage ou bien dans votre entrée pour un éclairage plus fonctionnel. Notre astuce déco : optez pour des ampoules avec une température de couleur « chaude » qui accentueront l’aspect chaleureux de ce luminaire et qui vous procureront un éclairage cocooning au quotidien. Luminaire compatible avec 3 ampoules E14 d’une puissance maximale de 40W chacune, soit 3x40W (ampoules non incluses). Dimensions : hauteur 38cm x diamètre 40cm. Existe également en coloris blanc ou bien dans la même gamme JAMIE en version lampadaire (blanc ou violine).', '40 cm - 38 cm - 40cm', '1.2 kg', 5, '125.00', 0, '2020-05-22', 1, 2),
(3, 'Suspension industrielle AREGUA noire en métal', 'AREGUA est une suspension évasée qui met la lumière en avant ainsi qu\'un éclairage chaud. Composée d\'aluminium, elle conserve la chaleur et installe un sentiment confortable au sein de l\'habitat. Son design est moderne. Idéale dans une cuisine, une entrée ou un séjour.', '40 cm - 38 cm - 40cm', '1.4 kg', 23, '69.90', 10, '2020-02-04', 1, 3),
(4, 'Suspension chambre RONDA rouge en coton', 'Avec sa matière coton délicate, la gamme de suspensions RONDA est idéale pour illuminer la chambre d\'une belle lumière douce et feutrée. La suspension RONDA affiche un beau diamètre de 50 cm révélant une forme boule dont de grandes bandes de coton s\'entrelacent, laisser filtrer la lumière par un design ajouré. on aime les courbes douces et élégantes qui façonnent cette belle suspension dont l\'éclairage homogène et chaleureux s\'adapte parfaitement aux pièces dédiées à la détente. Ce luminaire est compatible avec une ampoule E27 de 40 watts. Existe en coloris taupe, gris, noir et rouge.', '60 cm -110 cm', '1.35 kg', 4, '79.90', 10, '2020-01-23', 1, 3),
(5, 'Suspension design RETRO blanche en métal', 'Cette sublime suspension blanche RETRO va donner de l\'éclat à votre décoration d\'intérieur. Avec son double abat-jour aux proportions harmonieuses, la suspension RETRO va booster la déco de votre cuisine. Un joli diamètre de 40 cm, une finition blanc métallisé intemporelle et un design chic et épuré font de cette suspension RETRO une valeur sûre pour un éclairage zéro défaut! Elle diffuse une belle lumière douce, chaleureuse et homogène. Cette suspension est compatible avec une ampoule E27 de 40 watts.', '40 cm - 19 cm - 40 cm', '1.05 kg', 32, '49.90', 30, '2020-01-16', 1, 3),
(6, 'Plafonnier LED design JONAS blanc en PVC', 'Laissez entrer de la magie dans votre intérieur grâce au plafonnier LED design JONAS. Quoi de mieux pour impressionner vos invités qu’un luminaire donnant l’impression que des étoiles scintilles dans la pièce ? C’est exactement l’effet que procure ce sublime plafonnier ! Son diffuseur en PVC blanc cache de discrets motifs translucides qui se révèlent uniquement quand le luminaire est allumé. Ce plafonnier est livré avec une télécommande qui permet de varier l’intensité de l’ampoule LED de 22 watts intégrée mais aussi sa température en allant d’un blanc chaud de 3000 kelvins à un blanc froid de 5000 kelvins. Il trouvera parfaitement sa place dans un salon mais peut aussi être installé dans une chambre. Existe dans la même série JONAS en version 59 cm de diamètre.', '40 cm - 7.5 cm', '1.08 kg', 34, '135.00', 0, '2020-06-02', 1, 4),
(7, 'Plafonnier design rétro Led METALLO doré en métal et PVC', 'Déclinée en plafonnier une lumière et en applique trois lumières, la gamme Led METALLO vous surprendra par son élégance en toute sobriété. Au coloris or, le plafonnier METALLO diffusera une lumière étincelante, dans votre séjour ou votre entrée, en parfaite harmonie avec les aménagements de style chic et épuré.', '12 cm - 5.4 cm', '0.33 kg', 0, '39.90', 0, '2020-06-10', 1, 5),
(8, 'Lampadaire trépied HOLLYWOOD argenté ', 'Son abat-jour, qui reprend la forme d’un projecteur, que l’on retrouve ordinairement dans une salle de spectacle ou un studio photo, donne au lampadaire HOLLYWOOD un look original pour mettre en valeur votre pièce à vivre. Il est décliné en trois coloris et fonctionne avec une ampoule E27 de 40 watts.', '56 cm - 140 cm', '3.1 kg', 23, '139.90', 0, '2020-06-02', 2, 8),
(9, 'Lampadaire bois trépied BOR marron en pin naturel', 'Inspirée des instruments utilisés dans les studios pour stabiliser un appareil photo ou une caméra, cette version campagne chic du lampadaire trépied est un luminaire de charme qui donnera un cachet incontournable à votre intérieur. Le jeu des matières et des couleurs travaillé sur le lampadaire trépied BOR en fait un luminaire contemporain au subtil mélange des styles campagne, atelier et scandinave. Ses teintes sobres associant le marron glacé, le noir et le blanc se marient agréablement à des lignes droites et pures qui lui confèrent une allure douce et élégante. Avec 152 centimètres de hauteur, le lampadaire trépied BOR se pose au sol dans un esprit loft soft et décalé pour illuminer un bord de canapé. Parfaite solution d’éclairage d’ambiance indirect, ce lampadaire trépied en pin naturel procurera un éclairage chaleureux et cosy grâce à son abat-jour Empire en tissu blanc qui filtrera avec douceur la lumière. La grande force de ce luminaire trépied est de s’adapter à tous les styles déco. Le lampadaire BOR s’intègrera aussi bien dans une atmosphère vintage qu’industrielle, un décor moderne qu’un intérieur plus classique. Le salon, pièce à vivre par excellence, adoptera illico cet accessoire lumineux aux accents nordiques très en vogue. Ce luminaire est compatible avec une ampoule E27 d’une puissance de 60 watts. Existe dans la même série en modèle lampe.', '40 cm - 152 cm', '2.7 kg', 23, '129.90', 0, '2020-06-09', 2, 3),
(10, 'Lampadaire industriel JUSTIN blanc et gris anthracite en métal', 'La tête orientable vers le haut et le bas du lampadaire JUSTIN offre un éclairage indirect et directionnel très fonctionnel. Moderne et bicolore, il allie métal plein et métal ajouré pour s’adapter facilement aux intérieurs contemporains. JUSTIN se décline en applique baladeuse et suspension et fonctionne avec une ampoule E27 de 60 watts.', '25 cm - 145 cm', '2.9 kg', 23, '79.90', 0, '2020-06-08', 2, 7),
(11, 'Lampadaire design MEKANO rouge en métal', 'Le lampadaire design MEKANO est à la fois tendance et pratique. Avec son pied orientable et sa tête projecteur rotative, il offre de nombreuses solutions d’éclairage qui s’adapteront à tous vos besoins. Son look rétro est modernisé grâce à une structure en métal laqué qui peut compléter la décoration d’un bureau, d\'un séjour ou d’une chambre d’adolescent. Cette source de lumière secondaire est compatible avec une ampoule E27 de 40 watts et projette une lumière fonctionnelle et agréable non éblouissante. Existe dans la même série MEKANO en coloris noir, blanc et rose, et en version lampe de bureau en coloris noir, blanc, rouge et rose.', '26 cm 162 cm', '2.63 kg', 12, '89.90', 30, '2020-06-03', 2, 6),
(12, 'Lampadaire LINEAR en métal noir', 'Ce sublime lampadaire design fabriqué par la marque Markslöjd est un petit bijou de fonctionnalités pour la maison. Sa première fonction, qui est de vous éclairer évidemment, révèle un objet déco qui permet de jouer avec la lumière comme bon vous semble. Son bras articulé vous invite à régler la hauteur de votre abat-jour selon vos besoins, et son abat-jour orientable vous permet ensuite de diriger le flux lumineux vers la zone souhaitée ! Ce lampadaire articulé offre donc un double éclairage : tamisé pour une ambiance feutrée, intense sur une zone précise. Conçu en métal noir, il est sobre, épuré et résistant aux chocs. Question pratique, il est doté d\'un petit plateau circulaire pour y déposer ses accessoires et surtout d\'un port USB pour recharger tablette et smartphone. Un must-have ! Ce lampadaire noir est compatible avec une ampoule E14 de 40 watts.', '28 cm - 144 cm', '5 kg', 12, '149.90', 50, '2020-05-13', 2, 2),
(13, 'Lampadaire bois trépied VINTAGE noir ', 'Le lampadaire trépied VINTAGE rappelle incontestablement la forme d’un projecteur éclairant une scène de spectacle. Tandis que sa structure est en bois, son abat-jour est en métal pour un effet design garanti. Ce luminaire nécessite une ampoule E27 40W non-fournie pour fonctionner.', '62 cm - 150 cm', '3.23 kg', 34, '210.00', 0, '2020-06-08', 2, 8),
(14, 'Lampadaire design industriel JESPER gris béton en métal', 'Avec son look industriel et son coloris gris béton, le lampadaire JESPER s’adaptera parfaitement aux intérieurs modernes et tendance. Considéré comme un élément de décoration à part entière, il diffusera une lumière optimale réfléchie par son abat-jour en métal. Son coloris gris béton patiné donne une couleur \"factory\" à ce lampadaire, directement inspiré des projecteurs utilisés dans les ateliers. On aime son côté authentique et brut ainsi que son point lumineux articulé qui vous permettra d\'orienter le flux lumineux. Avec une belle hauteur de 156,5 centimètres, il habillera un bout de canapé en cuir vieilli dans un salon, trouvera sa place dans une entrée à la déco éclectique. Ce lampadaire nécessite une ampoule E27 de 40 watts.', '46 cm -156 cm', '5 kg', 12, '119.90', 30, '2020-01-14', 2, 5),
(15, 'Lampe design KNULLE grise taupe en métal', 'Avec son allure ultramoderne et sa silhouette tout en rondeurs, cette très belle lampe de table KNULLE affiche un design épuré et lumineux. Conçue en un seul bloc, la lampe design KNULLE révèle un abat-jour en forme de tube ouvert vers le bas qui diffuse une lumière intense et concentrée très chaleureuse. Parfaite solution d’éclaire d’appoint, elle viendra parfaire la déco d’un salon ou d’une grande pièce à vivre, et habiller une console dans une entrée ou une table de nuit dans une chambre au style contemporain. On succombe à son look minimaliste et son coloris taupe délicat qui ajoute de la luminosité à ce luminaire chic et moderne. On aime l’esprit rétro-futuriste que dégage la lampe de table design KNULLE, son gabarit de 28 cm de hauteur, l’élégance de ses lignes fuselées, la couleur sourde et naturelle de sa structure en métal. Ce luminaire est compatible avec une ampoule E14 d’une puissance de 40 watts. Utilisable avec une source lumineuse Led. Existe dans la même série KNULLE en coloris beige et bleu.', '15 cm - 28 cm', '0.95 kg', 34, '38.90', 0, '2020-06-16', 3, 9),
(16, 'Lampe de salon choclolat et beige en métal et tissu', 'La lampe NATURE avec ses pieds en métal minutieusement travaillés et ses deux abat-jour en tissu s’intégrera idéalement dans un intérieur de style classique. Charmante et pleine de douceur, cette lampe à poser se décline en plusieurs modèles et fonctionne avec deux ampoules E14 d’une puissance de 40 watts.', '16 cm - 65 cm', '1.3 kg', 43, '67.50', 0, '2020-06-02', 3, 8),
(17, 'Lampe à poser SMOOK en métal noir mat et verre fumé', 'Craquez sans plus attendre pour le charme moderne et convivial de cette belle lampe à poser SMOOK. Ce luminaire se compose d\'un pied de lampe forme cube en métal noir mat, ainsi que d\'une belle ampoule déco en verre fumé noir qui vous procurera un éclairage chaleureux au quotidien. Idéale en guise de lampe de chevet, elle trouvera aussi sans aucun doute sa place dans un coin de votre salon sur un meuble ou bien dans votre entrée sur une commode. Ce luminaire design fera sensation dans votre décoration d\'intérieur ! Lampe vendue avec une ampoule E27 d’une puissance de 4W et une intensité lumineuse de 100 lumens pour un éclairage chaleureux et une ambiance cocooning assurée. Dimensions : hauteur 24.5cm x diamètre 8.5cm x longueur câble 150cm. Interrupteur sur câble d’alimentation.', '8 cm - 25 cm', '0.51 kg', 12, '39.90', 10, '2020-04-21', 3, 10),
(18, 'Lampe industrielle Lenius', 'Design rétro et charme inconditionnel pour la lampe à poser LENIUS qui séduit tant par sa forme que ses matériaux et son coloris vieilli. Son abat-jour original diffuse, de façon homogène, la lumière d’une ampoule E27 de 60 watts. La gamme LENIUS se décline en nombreux modèles.', '13 cm - 40 cm', '1.62 kg', 4, '69.90', 0, '2020-06-09', 3, 11),
(19, 'Lampe de Bureau LAWYER', 'Très belle lampe à poser de la série LAWYER. Elle sublimera votre décoration avec beaucoup d\'originalité grƒce à son look raffiné et traditionnel. Elle diffuse une lumière de 60W pour un éclairage agréable et efficace. Idéal sur un bureau ou un meuble d\'appoint, elle donnera à votre pièce une touche authentique.', '26 cm - 38 cm', '2.5 kg', 12, '99.90', 20, '2019-10-15', 3, 12),
(20, 'Lampe tacticle BOHOS argenté et blanche en tissu', 'Moderne et graphique, la lampe BOHOS s’inscrit dans une tendance contemporaine et chic qui lui donne une allure fabuleuse avec son abat-jour blanc rectangulaire intégré au pied de la lampe chromé. Le mix des matières combine à merveille l’élégance et la robustesse du métal argenté à la douceur du tissu de l’abat-jour et de son coloris blanc épure. On aime ses lignes droites et géométriques qui impose un style minimaliste entre structure et précision et du design. Du haut de ses 55,70 centimètres, la lampe BOHOS affiche une allure ordonnée et élégante singulière. On aime son look qui fait partie de notre collection capsule « Designed exclusively for Keria* » 100% exclusive au design innovant, inventif et accessible. Avec la lampe BOHOS, vous avez la lumière au bout des doigts ! Voilà une lampe qui s’allume quand on l’effleure. Elle est dotée des fonctionnalités sensitive et tactile pour créer une lumière simple, efficace et design. Grâce à la technologie « touch », une simple pression du doigt suffit à activer la surface pour éclairer instantanément la lampe ! Autre avantage 2 en 1, cette lampe tactile offre trois réglages différents de luminosité. L’intensité lumineuse peut donc varier en fonction de vos besoins : lumière plus intense pour la lecture ou plus douce pour se détendre. Parfaite pour créer l’ambiance désirée. Exit les interrupteurs et commutateurs, avec notre lampe BOHOS « touch », l’éclairage se veut facile, ludique et stylé. En bout de canapé dans un espace salon, sur une console dans l’entrée ou en lampe de chevet, l’esprit design et fonctionnel de la lampe touch BOHOS donnera une note absolument exclusive à votre intérieur ! Ce luminaire est compatible avec une ampoule E14 de 40 watts de puissance. *dessiné exclusivement pour Keria par Olivier Toulouse.', '15 cm - 55 cm', '3.16 kg', 34, '119.00', 0, '2020-06-10', 3, 12),
(21, 'Applique murale avec liseuse HOLLIDAY noir  en métal', 'L’applique murale HOLIDAY s’inspire des décorations modernes pour proposer un luminaire à la fois élégant et pratique. Sa base en métal noir vernis supporte un abat-jour carré très tendance mais également une liseuse chromée. Cette applique permet donc de diffuser un éclairage diffus et homogène mais peut également devenir une source de lumière directionnelle. Le bras de la liseuse est entièrement flexible et peut pivoter dans tous les sens afin de cibler la lumière sur un endroit précis. Un bouton unique sur sa base permet de contrôler indépendamment les deux sources lumineuses. L’applique est compatible avec une ampoule E14 de 40 watts. Existe dans la même série HOLIDAY en coloris blanc.', '18 cm - 40 cm', '0.64 kg', 34, '170.00', 0, '2020-06-10', 4, 12),
(22, 'Applique CHISPY en métal argenté et tissu', 'L\'applique CHISPY dispose d\'un abat-jour bi-matière et bicolore qui accentue sa modernité. Idéale dans une entrée, un séjour ou une chambre, la diffusion de la lumière se fait autant vers le haut que vers le bas. Cette applique est compatible avec une ampoule E14 d\'une puissance de 40 watts.', '14 cm - 22 cm', '0.32 kg', 4, '28.90', 0, '2020-06-01', 4, 11),
(23, 'Applique murale SONIAN  blanche en verre ', 'Minimaliste et contemporaine, cette sublime applique murale SONIAN donne un coup d\'éclat à la décoration d\'intérieur. Cette applique en métal chromé ou repose sa verrerie carré blanche est idéale pour tous les intérieurs. Elle viendra la déco murale de l\'entrée, du couloir, de l\'escalier ou du salon avec sobriété et élégance. On aime sa simplicité, son look géométrique et ses lignes fuselées, droites et pures, son allure élégante.', '8 cm - 21 cm', '2.46 kg', 23, '24.90', 0, '2020-06-16', 4, 11),
(24, 'Spot murale WOODY orientable', 'Design et fonctionnel, le spot WOODY est fabriqué en bois clair d’Hévéa, ce qui lui donne une allure nature très réussie. Sa texture bois se marie parfaitement avec le métal chromé de sa structure et le verre de son diffuseur qui vient filtrer la lumière pour un confort visuel optimal. Grâce à sa tête lumineuse articulée, ce luminaire mural au look scandinave vous permet de diriger le flux lumineux vers la zone de votre choix en faisant simplement pivoter le spot. WOODY peut être utilisé comme éclairage d’accentuation dans une zone d’ombre, comme éclairage directionnel sur une zone stratégique, ou comme éclairage d’appoint pour compléter un éclairage principal zénithal dans une grande pièce à vivre ou un couloir. Il s’intègrera facilement dans des intérieurs de style contemporain, industriel ou nature. Ce luminaire est compatible avec une ampoule E14 d’une puissance de 40 watts. Existe dans la même série WOODY en réglette 2, 3 et 4 lumières.', '10 cm - 5 cm', '0.3 kg', 12, '18.90', 0, '2020-06-10', 5, 3),
(25, 'Spot orientable LIV orange en métal er verre', 'Apportez une touche de fraîcheur dans votre couloir ou votre pièce de vie avec ce spot. Son prix vous permettra d\'équiper une pièce entière avec un budget très réduit. Dans la même série, vous trouverez le plafonnier 3 lumières.', '8 cm -12 cm', '0.5 kg', 12, '7.90', 0, '2020-06-16', 5, 13),
(26, 'Spot murale movie en métal', 'Tout droit sorti d\'un plateau de tournage, nous vous proposons ce superbe spot seul 1 lumière orientable qui ira parfaitement dans votre salon. Dans la même série vous trouverez la réglette de spots 2 lumières mais également la réglette 4 lumières. Ampoule non incluse', '15 cm - 12 cm', '2.6 kg', 45, '29.00', 0, '2020-06-09', 5, 13),
(27, 'Applique murale extérieur GAS grise en métal', 'Pratique, cette applique de la série GAS saura s\'adapter à votre habitat. Diffusant une lumière de 35W, elle vous fournira un éclairage agréable et confortable. Fonctionnelle et discrète, elle s\'adaptera à toutes les décorations.', '9 cm - 11 cm', '0.4 kg', 45, '45.00', 0, '2020-05-05', 6, 12),
(28, 'Applique murale extérieur LARRAN noire en aluminium', 'Cette applique d\'extérieur Keria Luminaires s\'intègre à tout type d\'habitat. La transparence du verre et sa large surface permettent un éclairage puissant cette applique met en valeur une architecture, balise votre entrée, éclaire votre terrasse ou façade extérieure donnant sur le jardin.\"', '25 cm - 28 cm ', '1.2 kg', 0, '35.90', 0, '2020-04-14', 6, 3),
(29, 'Spot extérieur encastrable RIGA 3 argenté en métal', 'Le spot d\'extérieur encastrable RIGA 3 donnera une pointe tendance à votre extérieur grâce à son design contemporain. À disposer de part et d’autre d’une baie vitrée donnant sur une terrasse ou directement dans votre jardin, ce spot à l\'indice de protection IP65 spécialement conçu pour votre espace outdoor saura s’intégrer facilement. Il fonctionne avec une ampoule E27 de 15 watts.', '17 cm - 28 cm', '1 kg', 12, '38.90', 0, '2020-06-09', 6, 14),
(30, 'Applique extérieur LED DESIGN OUTDOOR', 'L’applique OUTDOOR, dotée de l’indice de protection IP44 contre les projections d’eau et l’humidité, est donc adaptée à une utilisation en extérieur. Cette applique Led oritnable dispose d’un diffuseur en acrylique satiné pour une luminosité intense et non-éblouissante. Son design tout en simplicité lui permet de s’intégrer dans une multitude d’environnements.', '21 cm - 11 cm ', '1 kg', 34, '260.00', 0, '2020-06-09', 6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `produits_couleurs`
--

CREATE TABLE `produits_couleurs` (
  `idx_produit` int(11) NOT NULL,
  `idx_couleur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits_couleurs`
--

INSERT INTO `produits_couleurs` (`idx_produit`, `idx_couleur`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 4),
(5, 2),
(6, 2),
(7, 5),
(8, 7),
(9, 7),
(10, 2),
(11, 4),
(12, 1),
(13, 7),
(14, 6),
(15, 6),
(16, 7),
(17, 1),
(18, 1),
(19, 3),
(20, 8),
(21, 1),
(22, 8),
(23, 2),
(24, 7),
(25, 9),
(26, 8),
(27, 1),
(28, 1),
(29, 8),
(30, 1),
(18, 5),
(19, 5);

-- --------------------------------------------------------

--
-- Structure de la table `produits_matieres`
--

CREATE TABLE `produits_matieres` (
  `idx_produit` int(11) NOT NULL,
  `idx_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits_matieres`
--

INSERT INTO `produits_matieres` (`idx_produit`, `idx_matiere`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(5, 3),
(6, 4),
(7, 3),
(8, 3),
(9, 5),
(10, 3),
(11, 3),
(12, 3),
(13, 5),
(14, 3),
(15, 3),
(16, 3),
(16, 2),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(22, 2),
(23, 3),
(23, 6),
(24, 3),
(24, 5),
(24, 6),
(25, 3),
(25, 6),
(26, 3),
(27, 3),
(28, 1),
(29, 3),
(30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id_type` int(11) NOT NULL,
  `typ_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id_type`, `typ_nom`) VALUES
(1, 'Plafonnier'),
(2, 'Lampadaire & liseuse'),
(3, 'Lampe à poser'),
(4, 'Applique'),
(5, 'Spot'),
(6, 'Luminaire extérieur'),
(7, 'Ampoule');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `couleurs`
--
ALTER TABLE `couleurs`
  ADD PRIMARY KEY (`id_couleur`);

--
-- Index pour la table `echelle_prix`
--
ALTER TABLE `echelle_prix`
  ADD PRIMARY KEY (`id_echelle_prix`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `idx_produit` (`idx_produit`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `idx_type` (`idx_type`),
  ADD KEY `idx_marque` (`idx_marque`);

--
-- Index pour la table `produits_couleurs`
--
ALTER TABLE `produits_couleurs`
  ADD KEY `idx_produit` (`idx_produit`),
  ADD KEY `idx_couleur` (`idx_couleur`);

--
-- Index pour la table `produits_matieres`
--
ALTER TABLE `produits_matieres`
  ADD KEY `idx_produit` (`idx_produit`),
  ADD KEY `idx_matiere` (`idx_matiere`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `couleurs`
--
ALTER TABLE `couleurs`
  MODIFY `id_couleur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `echelle_prix`
--
ALTER TABLE `echelle_prix`
  MODIFY `id_echelle_prix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`idx_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idx_type`) REFERENCES `types` (`id_type`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`idx_marque`) REFERENCES `marques` (`id_marque`);

--
-- Contraintes pour la table `produits_couleurs`
--
ALTER TABLE `produits_couleurs`
  ADD CONSTRAINT `produits_couleurs_ibfk_1` FOREIGN KEY (`idx_couleur`) REFERENCES `couleurs` (`id_couleur`),
  ADD CONSTRAINT `produits_couleurs_ibfk_2` FOREIGN KEY (`idx_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `produits_matieres`
--
ALTER TABLE `produits_matieres`
  ADD CONSTRAINT `produits_matieres_ibfk_1` FOREIGN KEY (`idx_matiere`) REFERENCES `matieres` (`id_matiere`),
  ADD CONSTRAINT `produits_matieres_ibfk_2` FOREIGN KEY (`idx_produit`) REFERENCES `produits` (`id_produit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
