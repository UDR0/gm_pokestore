-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 fév. 2026 à 18:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gm_pokestore_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `price`, `image`, `created_at`, `author_id`) VALUES
(2, 'bulbasaur', 'Au matin de sa vie, la graine sur son dos lui fournit les éléments dont il a besoin pour grandir.\n\nTypes: grass, poison | Taille: 0.7m | Poids: 6.9kg | Évolutions: bulbasaur -> ivysaur -> venusaur', 69, NULL, '2026-02-05 17:19:20', NULL),
(3, 'ivysaur', 'Lorsque le bourgeon sur son dos éclot, il répand un doux parfum pour célébrer sa floraison.\n\nTypes: grass, poison | Taille: 1m | Poids: 13kg | Évolutions: bulbasaur -> ivysaur -> venusaur', 78, NULL, '2026-02-05 17:19:20', NULL),
(4, 'venusaur', 'Le parfum de sa fleur se fait plus pénétrant les lendemains de pluie. Cela appâte les autres Pokémon.\n\nTypes: grass, poison | Taille: 2m | Poids: 100kg | Évolutions: bulbasaur -> ivysaur -> venusaur', 87, NULL, '2026-02-05 17:19:20', NULL),
(5, 'charmander', 'La flamme de sa queue symbolise sa vitalité. Elle est intense quand il est en bonne santé.\n\nTypes: fire | Taille: 0.6m | Poids: 8.5kg | Évolutions: charmander -> charmeleon -> charizard', 136, NULL, '2026-02-05 17:19:20', NULL),
(6, 'charmeleon', 'La nuit, la queue ardente du Reptincel brille comme une étoile dans son repaire montagneux.\n\nTypes: fire | Taille: 1.1m | Poids: 19kg | Évolutions: charmander -> charmeleon -> charizard', 145, NULL, '2026-02-05 17:19:20', NULL),
(7, 'charizard', 'On raconte que la flamme du Dracaufeu s’intensifie après un combat difficile.\n\nTypes: fire, flying | Taille: 1.7m | Poids: 90.5kg | Évolutions: charmander -> charmeleon -> charizard', 154, NULL, '2026-02-05 17:19:20', NULL),
(8, 'squirtle', 'Il se réfugie dans sa carapace et réplique en éclaboussant l’ennemi à la première occasion.\n\nTypes: water | Taille: 0.5m | Poids: 9kg | Évolutions: squirtle -> wartortle -> blastoise', 148, NULL, '2026-02-05 17:19:20', NULL),
(9, 'wartortle', 'On prétend qu’il vit 10 000 ans. Sa queue duveteuse est un symbole de longévité populaire.\n\nTypes: water | Taille: 1m | Poids: 22.5kg | Évolutions: squirtle -> wartortle -> blastoise', 157, NULL, '2026-02-05 17:19:20', NULL),
(10, 'blastoise', 'Les trombes d’eau projetées par les canons de sa carapace peuvent percer le métal le plus résistant.\n\nTypes: water | Taille: 1.6m | Poids: 85.5kg | Évolutions: squirtle -> wartortle -> blastoise', 166, NULL, '2026-02-05 17:19:20', NULL),
(11, 'caterpie', 'Ses antennes rouges libèrent une puanteur qui repousse l’ennemi. Il grandit par mues régulières.\n\nTypes: bug | Taille: 0.3m | Poids: 2.9kg | Évolutions: caterpie -> metapod -> butterfree', 150, NULL, '2026-02-05 17:19:20', NULL),
(12, 'metapod', 'Son corps frêle est protégé par sa carapace d’acier. Il encaisse les coups durs en attendant d’évoluer.\n\nTypes: bug | Taille: 0.7m | Poids: 9.9kg | Évolutions: caterpie -> metapod -> butterfree', 159, NULL, '2026-02-05 17:19:20', NULL),
(13, 'butterfree', 'Il raffole du nectar des fleurs. Il est capable de repérer la plus petite quantité de pollen.\n\nTypes: bug, flying | Taille: 1.1m | Poids: 32kg | Évolutions: caterpie -> metapod -> butterfree', 168, NULL, '2026-02-05 17:19:20', NULL),
(14, 'weedle', 'Il mange chaque jour son poids en feuilles. Il utilise l’aiguillon sur sa tête pour repousser l’ennemi.\n\nTypes: bug, poison | Taille: 0.3m | Poids: 3.2kg | Évolutions: weedle -> kakuna -> beedrill', 177, NULL, '2026-02-05 17:19:20', NULL),
(15, 'kakuna', 'Il se cache sous les feuilles et les branches pour fuir les prédateurs en attendant d’évoluer.\n\nTypes: bug, poison | Taille: 0.6m | Poids: 10kg | Évolutions: weedle -> kakuna -> beedrill', 186, NULL, '2026-02-05 17:19:20', NULL),
(16, 'beedrill', 'Il virevolte rapidement autour de l’ennemi et frappe de son dard empoisonné avant de décamper.\n\nTypes: bug, poison | Taille: 1m | Poids: 29.5kg | Évolutions: weedle -> kakuna -> beedrill', 195, NULL, '2026-02-05 17:19:20', NULL),
(17, 'pidgey', 'Ce Pokémon docile préfère éviter le combat. Toutefois, il se montre très féroce quand on l’agresse.\n\nTypes: normal, flying | Taille: 0.3m | Poids: 1.8kg | Évolutions: pidgey -> pidgeotto -> pidgeot', 204, NULL, '2026-02-05 17:19:20', NULL),
(18, 'pidgeotto', 'Il survole son vaste territoire en quête d’une proie avant de fondre sur elle toutes griffes en avant.\n\nTypes: normal, flying | Taille: 1.1m | Poids: 30kg | Évolutions: pidgey -> pidgeotto -> pidgeot', 213, NULL, '2026-02-05 17:19:20', NULL),
(19, 'pidgeot', 'En battant des ailes de toutes ses forces, Roucarnage génère une rafale à en déraciner les arbres.\n\nTypes: normal, flying | Taille: 1.5m | Poids: 39.5kg | Évolutions: pidgey -> pidgeotto -> pidgeot', 222, NULL, '2026-02-05 17:19:20', NULL),
(20, 'rattata', 'D’une prudence extrême, sa nature robuste lui permet de s’adapter à tous les terrains.\n\nTypes: normal | Taille: 0.3m | Poids: 3.5kg | Évolutions: rattata -> raticate', 231, NULL, '2026-02-05 17:19:20', NULL),
(21, 'raticate', 'Ses pattes arrière lui permettent de traverser les rivières. Il est toujours en quête de nourriture.\n\nTypes: normal | Taille: 0.7m | Poids: 18.5kg | Évolutions: rattata -> raticate', 240, NULL, '2026-02-05 17:19:20', NULL),
(22, 'spearow', 'Il fait battre vigoureusement ses petites ailes pour voler et cherche à manger dans l’herbe avec le bec.\n\nTypes: normal, flying | Taille: 0.3m | Poids: 2kg | Évolutions: spearow -> fearow', 249, NULL, '2026-02-05 17:19:20', NULL),
(23, 'fearow', 'Il a assez d’énergie pour voler toute la journée avec ses grandes ailes. Il frappe de son bec acéré.\n\nTypes: normal, flying | Taille: 1.2m | Poids: 38kg | Évolutions: spearow -> fearow', 258, NULL, '2026-02-05 17:19:20', NULL),
(24, 'ekans', 'Il se faufile dans l’herbe sans un bruit et frappe dans le dos quand sa proie s’y attend le moins.\n\nTypes: poison | Taille: 2m | Poids: 6.9kg | Évolutions: ekans -> arbok', 267, NULL, '2026-02-05 17:19:20', NULL),
(25, 'arbok', 'Il utilise la marque sur son ventre pour intimider l’ennemi. Il étouffe l’ennemi pétrifié par la peur.\n\nTypes: poison | Taille: 3.5m | Poids: 65kg | Évolutions: ekans -> arbok', 276, NULL, '2026-02-05 17:19:20', NULL),
(26, 'pikachu', 'Il lui arrive de remettre d’aplomb un Pikachu allié en lui envoyant une décharge électrique.\n\nTypes: electric | Taille: 0.4m | Poids: 6kg | Évolutions: pichu -> pikachu -> raichu', 320, NULL, '2026-02-05 17:19:20', NULL),
(27, 'raichu', 'Il se protège des décharges grâce à sa queue qui dissipe l’électricité dans le sol.\n\nTypes: electric | Taille: 0.8m | Poids: 30kg | Évolutions: pichu -> pikachu -> raichu', 329, NULL, '2026-02-05 17:19:20', NULL),
(28, 'sandshrew', 'Il vit sur des terres arides épargnées par la pluie. Il se roule en boule pour se protéger.\n\nTypes: ground | Taille: 0.6m | Poids: 12kg | Évolutions: sandshrew -> sandslash', 62, NULL, '2026-02-05 17:19:20', NULL),
(29, 'sandslash', 'Il se met en boule pour percuter l’ennemi. Ses épines aiguisées font beaucoup de dégâts.\n\nTypes: ground | Taille: 1m | Poids: 29.5kg | Évolutions: sandshrew -> sandslash', 71, NULL, '2026-02-05 17:19:20', NULL),
(30, 'nidoran-f', 'Bien qu’il rechigne à se battre, une goutte du poison sécrété par ses piquants peut s’avérer fatale.\n\nTypes: poison | Taille: 0.4m | Poids: 7kg | Évolutions: nidoran-f -> nidorina -> nidoqueen', 80, NULL, '2026-02-05 17:19:20', NULL),
(31, 'nidorina', 'Ce Pokémon dresse ses piquants en cas de danger. Ils poussent moins vite que ceux de Nidorino.\n\nTypes: poison | Taille: 0.8m | Poids: 20kg | Évolutions: nidoran-f -> nidorina -> nidoqueen', 89, NULL, '2026-02-05 17:19:20', NULL),
(32, 'nidoqueen', 'Son corps est recouvert d’écailles solides. Il donnera sa vie pour secourir les petits de son terrier.\n\nTypes: poison, ground | Taille: 1.3m | Poids: 60kg | Évolutions: nidoran-f -> nidorina -> nidoqueen', 98, NULL, '2026-02-05 17:19:20', NULL),
(33, 'nidoran-m', 'Il jauge le terrain en laissant ses oreilles dépasser de l’herbe. Il se défend avec sa corne toxique.\n\nTypes: poison | Taille: 0.5m | Poids: 9kg | Évolutions: nidoran-m -> nidorino -> nidoking', 107, NULL, '2026-02-05 17:19:20', NULL),
(34, 'nidorino', 'D’un tempérament violent, il empale l’ennemi sur sa corne qui distille un poison puissant.\n\nTypes: poison | Taille: 0.9m | Poids: 19.5kg | Évolutions: nidoran-m -> nidorino -> nidoking', 116, NULL, '2026-02-05 17:19:20', NULL),
(35, 'nidoking', 'Un coup de sa puissante queue peut briser un poteau téléphonique comme une allumette.\n\nTypes: poison, ground | Taille: 1.4m | Poids: 62kg | Évolutions: nidoran-m -> nidorino -> nidoking', 125, NULL, '2026-02-05 17:19:20', NULL),
(36, 'clefairy', 'On dit que ceux qui voient danser un groupe de Mélofée sous la pleine lune connaîtront un grand bonheur.\n\nTypes: fairy | Taille: 0.6m | Poids: 7.5kg | Évolutions: cleffa -> clefairy -> clefable', 134, NULL, '2026-02-05 17:19:20', NULL),
(37, 'clefable', 'Il est très farouche et se laisse rarement approcher. De plus, il détecte les sons à plus d’1 km.\n\nTypes: fairy | Taille: 1.3m | Poids: 40kg | Évolutions: cleffa -> clefairy -> clefable', 143, NULL, '2026-02-05 17:19:20', NULL),
(38, 'vulpix', 'Il envoie des boules de feu. Avec l’âge, ses six queues en forment de nouvelles.\n\nTypes: fire | Taille: 0.6m | Poids: 9.9kg | Évolutions: vulpix -> ninetales', 192, NULL, '2026-02-05 17:19:20', NULL),
(39, 'ninetales', 'On raconte que ses neuf queues détiennent un pouvoir mystique. Il peut vivre pendant mille ans.\n\nTypes: fire | Taille: 1.1m | Poids: 19.9kg | Évolutions: vulpix -> ninetales', 201, NULL, '2026-02-05 17:19:20', NULL),
(40, 'jigglypuff', 'Lorsqu’il roule ses grands yeux ronds, il entonne une berceuse qui endort son auditoire.\n\nTypes: normal, fairy | Taille: 0.5m | Poids: 5.5kg | Évolutions: igglybuff -> jigglypuff -> wigglytuff', 170, NULL, '2026-02-05 17:19:20', NULL),
(41, 'wigglytuff', 'Sa fourrure est d’une douceur incomparable au toucher. Il peut gonfler en aspirant de l’air.\n\nTypes: normal, fairy | Taille: 1m | Poids: 12kg | Évolutions: igglybuff -> jigglypuff -> wigglytuff', 179, NULL, '2026-02-05 17:19:20', NULL),
(42, 'zubat', 'Dépourvu d’yeux, il se repère dans l’espace grâce aux ultrasons qu’il émet avec sa bouche.\n\nTypes: poison, flying | Taille: 0.8m | Poids: 7.5kg | Évolutions: zubat -> golbat -> crobat', 188, NULL, '2026-02-05 17:19:20', NULL),
(43, 'golbat', 'Ses crocs acérés et creux peuvent pénétrer la plus épaisse des peaux et sucer le sang de la victime.\n\nTypes: poison, flying | Taille: 1.6m | Poids: 55kg | Évolutions: zubat -> golbat -> crobat', 197, NULL, '2026-02-05 17:19:20', NULL),
(44, 'oddish', 'En journée, il plante ses pieds-racines dans le sol. La nuit, il se promène en semant des graines.\n\nTypes: grass, poison | Taille: 0.5m | Poids: 5.4kg | Évolutions: oddish -> gloom -> vileplume', 206, NULL, '2026-02-05 17:19:20', NULL),
(45, 'gloom', 'L’odeur du nectar de sa bouche est si répugnante qu’elle agresse les narines à deux kilomètres.\n\nTypes: grass, poison | Taille: 0.8m | Poids: 8.6kg | Évolutions: oddish -> gloom -> vileplume', 215, NULL, '2026-02-05 17:19:20', NULL),
(46, 'vileplume', 'Ses pétales sont les plus grands du monde. Il marche en répandant un pollen extrêmement allergène.\n\nTypes: grass, poison | Taille: 1.2m | Poids: 18.6kg | Évolutions: oddish -> gloom -> vileplume', 224, NULL, '2026-02-05 17:19:20', NULL),
(47, 'paras', 'Des champignons appelés “tochukaso” poussent sur son dos. Ils évoluent avec le Paras hôte.\n\nTypes: bug, grass | Taille: 0.3m | Poids: 5.4kg | Évolutions: paras -> parasect', 233, NULL, '2026-02-05 17:19:20', NULL),
(48, 'parasect', 'Un champignon parasite plus gros que Parasect contrôle son corps. Il répand des spores empoisonnées.\n\nTypes: bug, grass | Taille: 1m | Poids: 29.5kg | Évolutions: paras -> parasect', 242, NULL, '2026-02-05 17:19:20', NULL),
(49, 'venonat', 'Ses grands yeux sont en fait des amas d’yeux minuscules. La nuit, il est attiré par la lumière.\n\nTypes: bug, poison | Taille: 1m | Poids: 30kg | Évolutions: venonat -> venomoth', 251, NULL, '2026-02-05 17:19:20', NULL),
(50, 'venomoth', 'Il répand ses écailles poudreuses en battant des ailes. Elles sont toxiques au toucher.\n\nTypes: bug, poison | Taille: 1.5m | Poids: 12.5kg | Évolutions: venonat -> venomoth', 260, NULL, '2026-02-05 17:19:20', NULL),
(51, 'diglett', 'Un Pokémon qui vit sous terre. Habitué aux souterrains, il fuit la lumière du jour.\n\nTypes: ground | Taille: 0.2m | Poids: 0.8kg | Évolutions: diglett -> dugtrio', 269, NULL, '2026-02-05 17:19:20', NULL),
(52, 'dugtrio', 'Ses trois têtes creusent le sol à tour de rôle. Il peut atteindre des profondeurs de 100 kilomètres.\n\nTypes: ground | Taille: 0.7m | Poids: 33.3kg | Évolutions: diglett -> dugtrio', 278, NULL, '2026-02-05 17:19:20', NULL),
(53, 'meowth', 'Son regard s’anime à la vue d’un objet brillant. C’est un Pokémon nocturne.\n\nTypes: normal | Taille: 0.4m | Poids: 4.2kg | Évolutions: meowth -> persian', 287, NULL, '2026-02-05 17:19:20', NULL),
(54, 'persian', 'Un Pokémon très snob. La taille du joyau qui orne son front alimente bien des débats parmi ses fans.\n\nTypes: normal | Taille: 1m | Poids: 32kg | Évolutions: meowth -> persian', 296, NULL, '2026-02-05 17:19:20', NULL),
(55, 'psyduck', 'Ses pouvoirs déconcertants et mystérieux lui font subir de constantes migraines.\n\nTypes: water | Taille: 0.8m | Poids: 19.6kg | Évolutions: psyduck -> golduck', 89, NULL, '2026-02-05 17:19:20', NULL),
(56, 'golduck', 'Ses membres palmés et son corps parfaitement adapté font de lui un nageur exceptionnel.\n\nTypes: water | Taille: 1.7m | Poids: 76.6kg | Évolutions: psyduck -> golduck', 98, NULL, '2026-02-05 17:19:20', NULL),
(57, 'mankey', 'Ils vivent en colonies sylvestres. Quand un Férosinge s’énerve, toute la colonie suit son exemple.\n\nTypes: fighting | Taille: 0.5m | Poids: 28kg | Évolutions: mankey -> primeape -> annihilape', 82, NULL, '2026-02-05 17:19:20', NULL),
(58, 'primeape', 'Il grogne quand on le toise, rugit quand on s’enfuit et devient fou de rage quand on le frappe.\n\nTypes: fighting | Taille: 1m | Poids: 32kg | Évolutions: mankey -> primeape -> annihilape', 91, NULL, '2026-02-05 17:19:20', NULL),
(59, 'growlithe', 'Un Pokémon très loyal. Il restera immobile jusqu’à ce que son Dresseur lui donne un ordre.\n\nTypes: fire | Taille: 0.7m | Poids: 19kg | Évolutions: growlithe -> arcanine', 140, NULL, '2026-02-05 17:19:20', NULL),
(60, 'arcanine', 'Son port altier et son attitude fière ont depuis longtemps conquis le cœur des hommes.\n\nTypes: fire | Taille: 1.9m | Poids: 155kg | Évolutions: growlithe -> arcanine', 149, NULL, '2026-02-05 17:19:20', NULL),
(61, 'poliwag', 'Sa peau est si mince qu’on voit ses organes internes. Il tient à peine sur ses nouveaux pieds.\n\nTypes: water | Taille: 0.6m | Poids: 12.4kg | Évolutions: poliwag -> poliwhirl -> poliwrath', 143, NULL, '2026-02-05 17:19:20', NULL),
(62, 'poliwhirl', 'La spirale qui orne son ventre ondule doucement. Celui qui la fixe est saisi d’une étrange torpeur.\n\nTypes: water | Taille: 1m | Poids: 20kg | Évolutions: poliwag -> poliwhirl -> poliwrath', 152, NULL, '2026-02-05 17:19:20', NULL),
(63, 'poliwrath', 'Il possède de sacrés biscoteaux. Il peut parcourir sans relâche l’Océan Pacifique.\n\nTypes: water, fighting | Taille: 1.3m | Poids: 54kg | Évolutions: poliwag -> poliwhirl -> poliwrath', 161, NULL, '2026-02-05 17:19:20', NULL),
(64, 'abra', 'L’utilisation de ses pouvoirs mentaux le fatigue tellement qu’il dort 18 heures par jour.\n\nTypes: psychic | Taille: 0.9m | Poids: 19.5kg | Évolutions: abra -> kadabra -> alakazam', 205, NULL, '2026-02-05 17:19:20', NULL),
(65, 'kadabra', 'Il fixe sa cuillère d’argent afin de concentrer son esprit et d’émettre un maximum d’ondes alpha.\n\nTypes: psychic | Taille: 1.3m | Poids: 56.5kg | Évolutions: abra -> kadabra -> alakazam', 214, NULL, '2026-02-05 17:19:20', NULL),
(66, 'alakazam', 'On dit que les cuillères qu’il tient en permanence ont été créées par la puissance de son esprit.\n\nTypes: psychic | Taille: 1.5m | Poids: 48kg | Évolutions: abra -> kadabra -> alakazam', 223, NULL, '2026-02-05 17:19:20', NULL),
(67, 'machop', 'Malgré sa petite taille, sa force lui permet de soulever plusieurs Racaillou à la fois.\n\nTypes: fighting | Taille: 0.8m | Poids: 19.5kg | Évolutions: machop -> machoke -> machamp', 172, NULL, '2026-02-05 17:19:20', NULL),
(68, 'machoke', 'Il soulève les plus lourdes charges avec plaisir et facilité. Il donne un coup de main tout en s’entraînant!\n\nTypes: fighting | Taille: 1.5m | Poids: 70.5kg | Évolutions: machop -> machoke -> machamp', 181, NULL, '2026-02-05 17:19:20', NULL),
(69, 'machamp', 'La puissance et la rapidité de ses quatre bras puissants font des ravages sur ses adversaires.\n\nTypes: fighting | Taille: 1.6m | Poids: 130kg | Évolutions: machop -> machoke -> machamp', 190, NULL, '2026-02-05 17:19:20', NULL),
(70, 'bellsprout', 'Il préfère les climats chauds et humides. Ses lianes peuvent capturer une proie en un clin d’œil.\n\nTypes: grass, poison | Taille: 0.7m | Poids: 4kg | Évolutions: bellsprout -> weepinbell -> victreebel', 199, NULL, '2026-02-05 17:19:20', NULL),
(71, 'weepinbell', 'Un Pokémon végétal. Il capture les proies étourdies en les endormant à l’aide d’une poudre toxique.\n\nTypes: grass, poison | Taille: 1m | Poids: 6.4kg | Évolutions: bellsprout -> weepinbell -> victreebel', 208, NULL, '2026-02-05 17:19:20', NULL),
(72, 'victreebel', 'Sa bouche sécrète un fluide à l’odeur de miel, qui s’avère être un acide extrêmement corrosif.\n\nTypes: grass, poison | Taille: 1.7m | Poids: 15.5kg | Évolutions: bellsprout -> weepinbell -> victreebel', 217, NULL, '2026-02-05 17:19:20', NULL),
(73, 'tentacool', 'Presque entièrement composé d’eau, son corps a tendance à se dessécher sur la terre ferme.\n\nTypes: water, poison | Taille: 0.9m | Poids: 45.5kg | Évolutions: tentacool -> tentacruel', 251, NULL, '2026-02-05 17:19:20', NULL),
(74, 'tentacruel', 'Ses 80 tentacules lui permettent d’emprisonner ses adversaires dans un redoutable filet venimeux.\n\nTypes: water, poison | Taille: 1.6m | Poids: 55kg | Évolutions: tentacool -> tentacruel', 260, NULL, '2026-02-05 17:19:20', NULL),
(75, 'geodude', 'Au repos, rien ne le distingue d’un vulgaire caillou. Malheur à ceux qui lui marchent dessus par mégarde!\n\nTypes: rock, ground | Taille: 0.4m | Poids: 20kg | Évolutions: geodude -> graveler -> golem', 244, NULL, '2026-02-05 17:19:20', NULL),
(76, 'graveler', 'Il dévale les montagnes pour se déplacer. Une fois qu’il a pris tout son élan, dur dur de l’arrêter!\n\nTypes: rock, ground | Taille: 1m | Poids: 105kg | Évolutions: geodude -> graveler -> golem', 253, NULL, '2026-02-05 17:19:20', NULL),
(77, 'golem', 'Aucun explosif ne pourrait entamer sa carapace de pierre. Il mue une fois par an.\n\nTypes: rock, ground | Taille: 1.4m | Poids: 300kg | Évolutions: geodude -> graveler -> golem', 262, NULL, '2026-02-05 17:19:20', NULL),
(78, 'ponyta', 'Chancelantes à la naissance, ses pattes deviennent très vite sûres et solides à force de galoper.\n\nTypes: fire | Taille: 1m | Poids: 30kg | Évolutions: ponyta -> rapidash', 311, NULL, '2026-02-05 17:19:20', NULL),
(79, 'rapidash', 'Au grand galop, sa crinière de feu disperse au vent une myriade d’étincelles ardentes.\n\nTypes: fire | Taille: 1.7m | Poids: 95kg | Évolutions: ponyta -> rapidash', 320, NULL, '2026-02-05 17:19:20', NULL),
(80, 'slowpoke', 'Bien que lent, c’est un pêcheur adroit qui utilise sa queue. Elle est insensible aux morsures.\n\nTypes: water, psychic | Taille: 1.2m | Poids: 36kg | Évolutions: slowpoke -> slowbro', 314, NULL, '2026-02-05 17:19:20', NULL),
(81, 'slowbro', 'Ce grand benêt connaît des éclairs de lucidité lorsque le Kokiyas de sa queue se met à mordre.\n\nTypes: water, psychic | Taille: 1.6m | Poids: 78.5kg | Évolutions: slowpoke -> slowbro', 323, NULL, '2026-02-05 17:19:20', NULL),
(82, 'magnemite', 'Plus la rotation de ses extrémités est rapide, plus la force du champ magnétique qu’il génère est grande.\n\nTypes: electric, steel | Taille: 0.3m | Poids: 6kg | Évolutions: magnemite -> magneton -> magnezone', 101, NULL, '2026-02-05 17:19:20', NULL),
(83, 'magneton', 'Des groupes apparaissent si des taches solaires couvrent le soleil. Ils brouillent les télévisions.\n\nTypes: electric, steel | Taille: 1m | Poids: 60kg | Évolutions: magnemite -> magneton -> magnezone', 110, NULL, '2026-02-05 17:19:21', NULL),
(84, 'farfetchd', 'Il ne peut pas vivre sans son légume, c’est pourquoi il le protégera au péril de sa vie.\n\nTypes: normal, flying | Taille: 0.8m | Poids: 15kg | Évolutions: farfetchd -> sirfetchd', 84, NULL, '2026-02-05 17:19:21', NULL),
(85, 'doduo', 'Ses deux cerveaux semblent communiquer leurs émotions grâce à un lien télépathique.\n\nTypes: normal, flying | Taille: 1.4m | Poids: 39.2kg | Évolutions: doduo -> dodrio', 93, NULL, '2026-02-05 17:19:21', NULL),
(86, 'dodrio', 'Quand Doduo connaît cette étrange évolution, l’une de ses têtes se dédouble. Il atteint les 60 km/h.\n\nTypes: normal, flying | Taille: 1.8m | Poids: 85.2kg | Évolutions: doduo -> dodrio', 102, NULL, '2026-02-05 17:19:21', NULL),
(87, 'seel', 'Un habitant des icebergs. En mer, il utilise la corne sur sa tête pour briser la banquise.\n\nTypes: water | Taille: 1.1m | Poids: 90kg | Évolutions: seel -> dewgong', 136, NULL, '2026-02-05 17:19:21', NULL),
(88, 'dewgong', 'Son corps est couvert d’un grand manteau blanc qui, dans la neige, le dissimule aux yeux des prédateurs.\n\nTypes: water, ice | Taille: 1.7m | Poids: 120kg | Évolutions: seel -> dewgong', 145, NULL, '2026-02-05 17:19:21', NULL),
(89, 'grimer', 'Il est né d’un torrent de boue exposé aux rayons X de la lune. Il vit dans les ordures.\n\nTypes: poison | Taille: 0.9m | Poids: 30kg | Évolutions: grimer -> muk', 129, NULL, '2026-02-05 17:19:21', NULL),
(90, 'muk', 'Son corps exsude un fluide toxique qui tue instantanément les plantes et les arbres au contact.\n\nTypes: poison | Taille: 1.2m | Poids: 30kg | Évolutions: grimer -> muk', 138, NULL, '2026-02-05 17:19:21', NULL),
(91, 'shellder', 'Il nage à reculons en ouvrant et en refermant ses deux coquilles. Il laisse traîner sa large langue.\n\nTypes: water | Taille: 0.3m | Poids: 4kg | Évolutions: shellder -> cloyster', 172, NULL, '2026-02-05 17:19:21', NULL),
(92, 'cloyster', 'Il se défend en fermant sa coquille et projette des piquants qui repoussent ses agresseurs.\n\nTypes: water, ice | Taille: 1.5m | Poids: 132.5kg | Évolutions: shellder -> cloyster', 181, NULL, '2026-02-05 17:19:21', NULL),
(93, 'gastly', 'Son corps composé de gaz toxique pourrait asphyxier n’importe qui en quelques secondes.\n\nTypes: ghost, poison | Taille: 1.3m | Poids: 0.1kg | Évolutions: gastly -> haunter -> gengar', 215, NULL, '2026-02-05 17:19:21', NULL),
(94, 'haunter', 'Il adore se tapir dans l’ombre et faire frissonner ses proies en leur touchant l’épaule.\n\nTypes: ghost, poison | Taille: 1.6m | Poids: 0.1kg | Évolutions: gastly -> haunter -> gengar', 224, NULL, '2026-02-05 17:19:21', NULL),
(95, 'gengar', 'Si vous croisez un regard inquiétant qui perce la nuit, c’est sûrement un Ectoplasma.\n\nTypes: ghost, poison | Taille: 1.5m | Poids: 40.5kg | Évolutions: gastly -> haunter -> gengar', 233, NULL, '2026-02-05 17:19:21', NULL),
(96, 'onix', 'Il se nourrit des pierres qu’il rencontre en creusant le sol. Il peut creuser à 80 km/h!\n\nTypes: rock, ground | Taille: 8.8m | Poids: 210kg | Évolutions: onix -> steelix', 192, NULL, '2026-02-05 17:19:21', NULL),
(97, 'drowzee', 'Son grand nez lui permet de lire les rêves d’autrui. Il adore les songes amusants.\n\nTypes: psychic | Taille: 1m | Poids: 32.4kg | Évolutions: drowzee -> hypno', 261, NULL, '2026-02-05 17:19:21', NULL),
(98, 'hypno', 'La vue de son pendule oscillant endort en trois secondes, même quand on vient de se réveiller.\n\nTypes: psychic | Taille: 1.6m | Poids: 75.6kg | Évolutions: drowzee -> hypno', 270, NULL, '2026-02-05 17:19:21', NULL),
(99, 'krabby', 'Il creuse son terrier sur des plages sablonneuses. Ses pinces repoussent si on les brise.\n\nTypes: water | Taille: 0.4m | Poids: 6.5kg | Évolutions: krabby -> kingler', 244, NULL, '2026-02-05 17:19:21', NULL),
(100, 'kingler', 'Sa grande pince possède une puissance de 10 000 chevaux. Son poids la rend difficile à manier.\n\nTypes: water | Taille: 1.3m | Poids: 60kg | Évolutions: krabby -> kingler', 253, NULL, '2026-02-05 17:19:21', NULL),
(101, 'voltorb', 'Il ressemble à une Poké Ball. Ce Pokémon dangereux peut exploser ou s’électrifier au toucher.\n\nTypes: electric | Taille: 0.5m | Poids: 10.4kg | Évolutions: voltorb -> electrode', 272, NULL, '2026-02-05 17:19:21', NULL),
(102, 'electrode', 'Il se laisse porter par les vents lorsque son corps est gonflé d’électricité à en éclater.\n\nTypes: electric | Taille: 1.2m | Poids: 66.6kg | Évolutions: voltorb -> electrode', 281, NULL, '2026-02-05 17:19:21', NULL),
(103, 'exeggcute', 'Ces six œufs communiquent par télépathie. Ils peuvent se réunir rapidement si on les sépare.\n\nTypes: grass, psychic | Taille: 0.4m | Poids: 2.5kg | Évolutions: exeggcute -> exeggutor', 255, NULL, '2026-02-05 17:19:21', NULL),
(104, 'exeggutor', 'On l’appelle “jungle sur pattes”. Si une tête devient trop grosse, elle tombe et produit un Noeunoeuf.\n\nTypes: grass, psychic | Taille: 2m | Poids: 120kg | Évolutions: exeggcute -> exeggutor', 264, NULL, '2026-02-05 17:19:21', NULL),
(105, 'cubone', 'Il pleure en pensant à sa mère disparue, et ses larmes résonnent dans son crâne creux.\n\nTypes: ground | Taille: 0.4m | Poids: 6.5kg | Évolutions: cubone -> marowak', 273, NULL, '2026-02-05 17:19:21', NULL),
(106, 'marowak', 'Ce Pokémon sauvage possède des os depuis sa naissance. Il s’en sert pour combattre avec dextérité.\n\nTypes: ground | Taille: 1m | Poids: 45kg | Évolutions: cubone -> marowak', 282, NULL, '2026-02-05 17:19:21', NULL),
(107, 'hitmonlee', 'Ses pattes élastiques s’allongent, ce qui ne manque jamais de surprendre au premier combat.\n\nTypes: fighting | Taille: 1.5m | Poids: 49.8kg | Évolutions: tyrogue -> hitmonlee', 291, NULL, '2026-02-05 17:19:21', NULL),
(108, 'hitmonchan', 'Même le béton cède sous ses poings dévastateurs. Au combat, il s’essouffle au bout de 3 minutes.\n\nTypes: fighting | Taille: 1.4m | Poids: 50.2kg | Évolutions: tyrogue -> hitmonchan', 300, NULL, '2026-02-05 17:19:21', NULL),
(109, 'lickitung', 'Quand il déploie sa langue de près de deux mètres, sa queue s’agite. Elles seraient reliées entre elles.\n\nTypes: normal | Taille: 1.2m | Poids: 65.5kg | Évolutions: lickitung -> lickilicky', 68, NULL, '2026-02-05 17:19:21', NULL),
(110, 'koffing', 'Il flotte en retenant des gaz plus légers que l’air. Ceux-ci sont explosifs, en plus d’être fétides.\n\nTypes: poison | Taille: 0.6m | Poids: 1kg | Évolutions: koffing -> weezing', 77, NULL, '2026-02-05 17:19:21', NULL),
(111, 'weezing', 'Il grandit en absorbant les gaz des détritus. Des triplés existent, bien qu’ils soient fort rares.\n\nTypes: poison | Taille: 1.2m | Poids: 9.5kg | Évolutions: koffing -> weezing', 86, NULL, '2026-02-05 17:19:21', NULL),
(112, 'rhyhorn', 'Ses puissantes charges pourraient démolir n’importe quel bâtiment. Dommage qu’il soit stupide.\n\nTypes: ground, rock | Taille: 1m | Poids: 115kg | Évolutions: rhyhorn -> rhydon -> rhyperior', 95, NULL, '2026-02-05 17:19:21', NULL),
(113, 'rhydon', 'La station debout a libéré ses pattes avant et l’a rendu plus intelligent, mais il est distrait.\n\nTypes: ground, rock | Taille: 1.9m | Poids: 120kg | Évolutions: rhyhorn -> rhydon -> rhyperior', 104, NULL, '2026-02-05 17:19:21', NULL),
(114, 'chansey', 'Ce Pokémon très serviable distribue ses œufs hautement nutritifs aux humains et Pokémon blessés.\n\nTypes: normal | Taille: 1.1m | Poids: 34.6kg | Évolutions: happiny -> chansey -> blissey', 113, NULL, '2026-02-05 17:19:21', NULL),
(115, 'tangela', 'Il se cache derrière des lianes bleues recouvertes d’un fin duvet. Il est chatouilleux.\n\nTypes: grass | Taille: 1m | Poids: 35kg | Évolutions: tangela -> tangrowth', 122, NULL, '2026-02-05 17:19:21', NULL),
(116, 'kangaskhan', 'Il élève ses petits dans sa poche ventrale. Il attend d’être en lieu sûr pour les laisser jouer dehors.\n\nTypes: normal | Taille: 2.2m | Poids: 80kg | Évolutions: kangaskhan', 131, NULL, '2026-02-05 17:19:21', NULL),
(117, 'horsea', 'Il niche à l’ombre du corail. Quand il se sent menacé, il disparaît dans un nuage d’encre opaque.\n\nTypes: water | Taille: 0.4m | Poids: 8kg | Évolutions: horsea -> seadra -> kingdra', 165, NULL, '2026-02-05 17:19:21', NULL),
(118, 'seadra', 'Son épine dorsale le protège. Ses os et ses nageoires sont très prisés en médecine traditionnelle.\n\nTypes: water | Taille: 1.2m | Poids: 25kg | Évolutions: horsea -> seadra -> kingdra', 174, NULL, '2026-02-05 17:19:21', NULL),
(119, 'goldeen', 'Malgré son élégance quand il nage, ses coups de corne sont redoutables.\n\nTypes: water | Taille: 0.6m | Poids: 15kg | Évolutions: goldeen -> seaking', 183, NULL, '2026-02-05 17:19:21', NULL),
(120, 'seaking', 'En automne, à la saison des amours, il fait des réserves de graisse et arbore des couleurs chatoyantes.\n\nTypes: water | Taille: 1.3m | Poids: 39kg | Évolutions: goldeen -> seaking', 192, NULL, '2026-02-05 17:19:21', NULL),
(121, 'staryu', 'Même amoché, son corps se régénère tant que le noyau rouge est intact. Le noyau s’illumine à minuit.\n\nTypes: water | Taille: 0.8m | Poids: 34.5kg | Évolutions: staryu -> starmie', 201, NULL, '2026-02-05 17:19:21', NULL),
(122, 'starmie', 'Un noyau rouge trône en son centre. Il envoie des signaux radio mystérieux vers le ciel nocturne.\n\nTypes: water, psychic | Taille: 1.1m | Poids: 80kg | Évolutions: staryu -> starmie', 210, NULL, '2026-02-05 17:19:21', NULL),
(123, 'mr-mime', 'En modifiant les molécules de l’air du bout de ses doigts, il parvient à créer un mur invisible devant lui.\n\nTypes: psychic, fairy | Taille: 1.3m | Poids: 54.5kg | Évolutions: mime-jr -> mr-mime -> mr-rime', 254, NULL, '2026-02-05 17:19:21', NULL),
(124, 'scyther', 'À force de trancher des objets solides, les faux de ses bras sont très aiguisées.\n\nTypes: bug, flying | Taille: 1.5m | Poids: 56kg | Évolutions: scyther -> scizor', 203, NULL, '2026-02-05 17:19:21', NULL),
(125, 'jynx', 'Son cri ressemble à des paroles humaines. Mais nul n’est jamais parvenu à les comprendre.\n\nTypes: ice, psychic | Taille: 1.4m | Poids: 40.6kg | Évolutions: smoochum -> jynx', 212, NULL, '2026-02-05 17:19:21', NULL),
(126, 'electabuzz', 'Il fait tournoyer ses bras pour donner de la force à ses coups. Profitez-en pour filer!\n\nTypes: electric | Taille: 1.1m | Poids: 30kg | Évolutions: elekid -> electabuzz -> electivire', 256, NULL, '2026-02-05 17:19:21', NULL),
(127, 'magmar', 'Quand il respire profondément, des vagues de chaleur émanent de son corps et le rendent difficile à voir.\n\nTypes: fire | Taille: 1.3m | Poids: 44.5kg | Évolutions: magby -> magmar -> magmortar', 270, NULL, '2026-02-05 17:19:21', NULL),
(128, 'pinsir', 'Il serre les proies dans ses pinces pour les trancher en deux. S’il n’y arrive pas, il les jette au loin.\n\nTypes: bug | Taille: 1.5m | Poids: 55kg | Évolutions: pinsir', 239, NULL, '2026-02-05 17:19:21', NULL),
(129, 'tauros', 'Après avoir choisi sa cible, il fonce dessus tête baissée. Il est réputé pour sa nature violente.\n\nTypes: normal | Taille: 1.4m | Poids: 88.4kg | Évolutions: tauros', 248, NULL, '2026-02-05 17:19:21', NULL),
(130, 'magikarp', 'Un vénérable Magicarpe peut franchir une montagne en utilisant Trempette. Mais c’est tout...\n\nTypes: water | Taille: 0.9m | Poids: 10kg | Évolutions: magikarp -> gyarados', 282, NULL, '2026-02-05 17:19:21', NULL),
(131, 'gyarados', 'Quand il se laisse emporter par la rage, il ne se calme qu’après avoir détruit tout ce qui l’entoure.\n\nTypes: water, flying | Taille: 6.5m | Poids: 235kg | Évolutions: magikarp -> gyarados', 291, NULL, '2026-02-05 17:19:21', NULL),
(132, 'lapras', 'Il aime naviguer en portant des humains et des Pokémon sur son dos. Il comprend le langage humain.\n\nTypes: water, ice | Taille: 2.5m | Poids: 220kg | Évolutions: lapras', 300, NULL, '2026-02-05 17:19:21', NULL),
(133, 'ditto', 'Il a la capacité de modifier sa structure cellulaire pour prendre l’apparence de ce qu’il voit.\n\nTypes: normal | Taille: 0.3m | Poids: 4kg | Évolutions: ditto', 284, NULL, '2026-02-05 17:19:21', NULL),
(134, 'eevee', 'Son ADN particulier lui permet de s’adapter très rapidement à son environnement.\n\nTypes: normal | Taille: 0.3m | Poids: 6.5kg | Évolutions: eevee -> vaporeon', 293, NULL, '2026-02-05 17:19:21', NULL),
(135, 'vaporeon', 'Sa composition moléculaire est proche de celle de l’eau, ce qui lui permet de se liquéfier.\n\nTypes: water | Taille: 1m | Poids: 29kg | Évolutions: eevee -> vaporeon', 86, NULL, '2026-02-05 17:19:21', NULL),
(136, 'jolteon', 'Face au danger, il fait appel à l’électricité pour dresser ses poils et lancer des décharges.\n\nTypes: electric | Taille: 0.8m | Poids: 24.5kg | Évolutions: eevee -> jolteon', 105, NULL, '2026-02-05 17:19:21', NULL),
(137, 'flareon', 'L’air qu’il inspire est chauffé par la glande enflammée de son corps, atteignant les 1 700 °C.\n\nTypes: fire | Taille: 0.9m | Poids: 25kg | Évolutions: eevee -> flareon', 119, NULL, '2026-02-05 17:19:21', NULL),
(138, 'porygon', 'Ce Pokémon créé par des scientifiques peut arpenter librement le cyberespace.\n\nTypes: normal | Taille: 0.8m | Poids: 36.5kg | Évolutions: porygon -> porygon2 -> porygon-z', 88, NULL, '2026-02-05 17:19:21', NULL),
(139, 'omanyte', 'Un Pokémon ramené à la vie par la science à partir d’un fossile. Il peuplait autrefois les mers.\n\nTypes: rock, water | Taille: 0.4m | Poids: 7.5kg | Évolutions: omanyte -> omastar', 97, NULL, '2026-02-05 17:19:21', NULL),
(140, 'omastar', 'On pense que ce Pokémon a disparu parce que sa coquille en spirale était devenue trop grosse.\n\nTypes: rock, water | Taille: 1m | Poids: 35kg | Évolutions: omanyte -> omastar', 106, NULL, '2026-02-05 17:19:21', NULL),
(141, 'kabuto', 'On pense qu’il peuplait les plages il y a 300 millions d’années. Il est protégé par une coquille robuste.\n\nTypes: rock, water | Taille: 0.5m | Poids: 11.5kg | Évolutions: kabuto -> kabutops', 115, NULL, '2026-02-05 17:19:21', NULL),
(142, 'kabutops', 'On pense que ce Pokémon est venu sur la terre ferme pour suivre l’évolution de ses proies.\n\nTypes: rock, water | Taille: 1.3m | Poids: 40.5kg | Évolutions: kabuto -> kabutops', 124, NULL, '2026-02-05 17:19:21', NULL),
(143, 'aerodactyl', 'Un Pokémon qui arpentait le ciel au temps des dinosaures. Ses crocs sont pareils à des scies.\n\nTypes: rock, flying | Taille: 1.8m | Poids: 59kg | Évolutions: aerodactyl', 133, NULL, '2026-02-05 17:19:21', NULL),
(144, 'snorlax', 'Une fois le ventre plein, il est trop amorphe pour lever le petit doigt. Sautez sur son ventre!\n\nTypes: normal | Taille: 2.1m | Poids: 460kg | Évolutions: munchlax -> snorlax', 142, NULL, '2026-02-05 17:19:21', NULL),
(145, 'articuno', 'Un Pokémon Oiseau légendaire. Il peut provoquer des blizzards en gelant l’humidité de l’air.\n\nTypes: ice, flying | Taille: 1.7m | Poids: 55.4kg | Évolutions: articuno', 151, NULL, '2026-02-05 17:19:21', NULL),
(146, 'zapdos', 'Un Pokémon Oiseau légendaire dont on dit qu’il vit dans les nuages d’orage. Il contrôle la foudre.\n\nTypes: electric, flying | Taille: 1.6m | Poids: 52.6kg | Évolutions: zapdos', 195, NULL, '2026-02-05 17:19:21', NULL),
(147, 'moltres', 'L’un des Pokémon Oiseaux légendaires. On dit que sa venue annonce l’arrivée du printemps.\n\nTypes: fire, flying | Taille: 2m | Poids: 60kg | Évolutions: moltres', 209, NULL, '2026-02-05 17:19:21', NULL),
(148, 'dratini', 'On l’appelle “Pokémon mirage” en raison de sa rareté. On a découvert sa mue.\n\nTypes: dragon | Taille: 1.8m | Poids: 3.3kg | Évolutions: dratini -> dragonair -> dragonite', 298, NULL, '2026-02-05 17:19:21', NULL),
(149, 'dragonair', 'La météo change brusquement quand il est entouré d’une aura. On dit qu’il peuple les mers et les lacs.\n\nTypes: dragon | Taille: 4m | Poids: 16.5kg | Évolutions: dratini -> dragonair -> dragonite', 307, NULL, '2026-02-05 17:19:21', NULL),
(150, 'dragonite', 'On raconte qu’il vit quelque part en mer. Il guide les équipages naufragés jusqu’à la terre ferme.\n\nTypes: dragon, flying | Taille: 2.2m | Poids: 210kg | Évolutions: dratini -> dragonair -> dragonite', 316, NULL, '2026-02-05 17:19:21', NULL),
(151, 'mewtwo', 'Un Pokémon conçu en réorganisant les gènes de Mew. On raconte qu’il s’agit du Pokémon le plus féroce.\n\nTypes: psychic | Taille: 2m | Poids: 122kg | Évolutions: mewtwo', 265, NULL, '2026-02-05 17:19:21', NULL),
(152, 'mew', 'Nombre de scientifiques voient en lui l’ancêtre des Pokémon car il maîtrise toutes leurs capacités.\n\nTypes: psychic | Taille: 0.4m | Poids: 4kg | Évolutions: mew', 274, NULL, '2026-02-05 17:19:21', NULL),
(153, 'Geof', 'Gros zizou', 1, '', '2026-02-24 15:31:37', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `article_id`) VALUES
(3, 1, 83);

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `total`, `address`, `city`, `postal_code`, `created_at`) VALUES
(1, 1, 100, '12 avenue du zeub', 'Vence', '06140', '2026-02-05 16:50:38'),
(2, 1, 220, '12 avenue du zeub', 'Vence', '06140', '2026-02-05 22:00:06'),
(3, 1, 110, '12 avenue du zeub', 'Vence', '06140', '2026-02-06 14:20:29'),
(4, 1, 990, '12 avenue du zeub', 'Vence', '06140', '2026-02-06 14:20:55');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `article_id`, `quantity`) VALUES
(2, 2, 10),
(3, 3, 10),
(4, 4, 10),
(5, 5, 10),
(6, 6, 10),
(7, 7, 10),
(8, 8, 10),
(9, 9, 10),
(10, 10, 10),
(11, 11, 10),
(12, 12, 10),
(13, 13, 10),
(14, 14, 10),
(15, 15, 10),
(16, 16, 10),
(17, 17, 10),
(18, 18, 10),
(19, 19, 10),
(20, 20, 10),
(21, 21, 10),
(22, 22, 10),
(23, 23, 10),
(24, 24, 10),
(25, 25, 10),
(26, 26, 10),
(27, 27, 10),
(28, 28, 10),
(29, 29, 10),
(30, 30, 10),
(31, 31, 10),
(32, 32, 10),
(33, 33, 10),
(34, 34, 10),
(35, 35, 10),
(36, 36, 10),
(37, 37, 10),
(38, 38, 10),
(39, 39, 10),
(40, 40, 10),
(41, 41, 10),
(42, 42, 10),
(43, 43, 10),
(44, 44, 10),
(45, 45, 10),
(46, 46, 10),
(47, 47, 10),
(48, 48, 10),
(49, 49, 10),
(50, 50, 10),
(51, 51, 10),
(52, 52, 10),
(53, 53, 10),
(54, 54, 10),
(55, 55, 10),
(56, 56, 10),
(57, 57, 10),
(58, 58, 10),
(59, 59, 10),
(60, 60, 10),
(61, 61, 10),
(62, 62, 10),
(63, 63, 10),
(64, 64, 10),
(65, 65, 10),
(66, 66, 10),
(67, 67, 10),
(68, 68, 10),
(69, 69, 10),
(70, 70, 10),
(71, 71, 10),
(72, 72, 10),
(73, 73, 10),
(74, 74, 10),
(75, 75, 10),
(76, 76, 10),
(77, 77, 10),
(78, 78, 10),
(79, 79, 10),
(80, 80, 10),
(81, 81, 10),
(82, 82, 10),
(83, 83, 0),
(84, 84, 10),
(85, 85, 10),
(86, 86, 10),
(87, 87, 10),
(88, 88, 10),
(89, 89, 10),
(90, 90, 10),
(91, 91, 10),
(92, 92, 10),
(93, 93, 10),
(94, 94, 10),
(95, 95, 10),
(96, 96, 10),
(97, 97, 10),
(98, 98, 10),
(99, 99, 10),
(100, 100, 10),
(101, 101, 10),
(102, 102, 10),
(103, 103, 10),
(104, 104, 10),
(105, 105, 10),
(106, 106, 10),
(107, 107, 10),
(108, 108, 10),
(109, 109, 10),
(110, 110, 10),
(111, 111, 10),
(112, 112, 10),
(113, 113, 10),
(114, 114, 10),
(115, 115, 10),
(116, 116, 10),
(117, 117, 10),
(118, 118, 10),
(119, 119, 10),
(120, 120, 10),
(121, 121, 10),
(122, 122, 10),
(123, 123, 10),
(124, 124, 10),
(125, 125, 10),
(126, 126, 10),
(127, 127, 10),
(128, 128, 10),
(129, 129, 10),
(130, 130, 10),
(131, 131, 10),
(132, 132, 10),
(133, 133, 10),
(134, 134, 10),
(135, 135, 10),
(136, 136, 10),
(137, 137, 10),
(138, 138, 10),
(139, 139, 10),
(140, 140, 10),
(141, 141, 10),
(142, 142, 10),
(143, 143, 10),
(144, 144, 10),
(145, 145, 10),
(146, 146, 10),
(147, 147, 10),
(148, 148, 10),
(149, 149, 10),
(150, 150, 10),
(151, 151, 10),
(152, 152, 10),
(153, 153, 20);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` float DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `balance`, `avatar`, `role`) VALUES
(1, 'Matias', 'matias.bouchenoire@ynov.com', '$2y$10$mCOEY/AF5tYOV1w8.60m2OebzuXTTAjhIVgXiD70ldey5hXB8CoiO', 10, NULL, 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_fav` (`user_id`,`article_id`);

--
-- Index pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

--
-- Contraintes pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
