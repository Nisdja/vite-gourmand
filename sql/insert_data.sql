USE vite_gourmand;

-- =====================================
-- THEMES
-- =====================================

INSERT INTO themes (nom) VALUES
('Noël'),
('Pâques'),
('Classique'),
('Événement');

-- =====================================
-- REGIMES
-- =====================================

INSERT INTO regimes (nom) VALUES
('Classique'),
('Végétarien'),
('Vegan'),
('Sans gluten');

-- =====================================
-- ALLERGENES
-- =====================================

INSERT INTO allergenes (nom) VALUES
('Gluten'),
('Lait'),
('Œufs'),
('Poisson'),
('Crustacés'),
('Soja'),
('Arachides'),
('Fruits à coque'),
('Moutarde'),
('Sésame');

-- =====================================
-- HORAIRES
-- =====================================

INSERT INTO horaires (jour, ouverture, fermeture) VALUES
('Lundi','09:00:00','18:00:00'),
('Mardi','09:00:00','18:00:00'),
('Mercredi','09:00:00','18:00:00'),
('Jeudi','09:00:00','18:00:00'),
('Vendredi','09:00:00','20:00:00'),
('Samedi','10:00:00','20:00:00'),
('Dimanche','10:00:00','14:00:00');

-- =====================================
-- PLATS
-- =====================================

INSERT INTO plats (nom, description, type) VALUES
('Foie gras maison','Foie gras artisanal','entree'),
('Saumon fumé','Saumon fumé écossais','entree'),
('Velouté de potimarron','Velouté maison','entree'),

('Magret de canard','Sauce miel','plat'),
('Bœuf bourguignon','Recette traditionnelle','plat'),
('Filet de saumon','Sauce citron','plat'),
('Lasagnes végétariennes','Légumes grillés','plat'),

('Bûche de Noël','Dessert traditionnel','dessert'),
('Fondant au chocolat','Cœur coulant','dessert'),
('Tarte aux pommes','Maison','dessert');

-- =====================================
-- MENUS
-- =====================================

INSERT INTO menus
(titre,description,theme_id,regime_id,nb_personnes_min,prix,conditions_menu,stock)
VALUES

(
'Menu Noël Prestige',
'Menu gastronomique pour les fêtes.',
1,
1,
4,
160,
'Commande 7 jours avant.',
10
),

(
'Menu Vegan',
'Cuisine 100 % végétale.',
3,
3,
2,
60,
'Commande 48 heures avant.',
15
),

(
'Menu Mariage',
'Grand menu pour événements.',
4,
1,
20,
950,
'Commande 3 semaines avant.',
5
);

-- =====================================
-- MENU / PLAT
-- =====================================

INSERT INTO menu_plat VALUES
(1,1),
(1,4),
(1,8),

(2,3),
(2,7),
(2,10),

(3,2),
(3,5),
(3,9);

-- =====================================
-- ALLERGENES
-- =====================================

INSERT INTO plat_allergene VALUES
(1,2),
(2,4),
(4,2),
(5,1),
(7,1),
(8,2),
(9,2),
(10,1);

-- =====================================
-- IMAGES
-- =====================================

INSERT INTO images_menu(menu_id,image) VALUES
(1,'noel1.jpg'),
(1,'noel2.jpg'),
(2,'vegan1.jpg'),
(2,'vegan2.jpg'),
(3,'mariage1.jpg');