DROP TABLE IF EXISTS Recipies;
DROP TABLE IF EXISTS ProducedPallets;
DROP TABLE IF EXISTS Blocked;
DROP TABLE IF EXISTS OrderedPallets;
DROP TABLE IF EXISTS Cookies;
DROP TABLE IF EXISTS Ingredients;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Customers;

CREATE TABLE Cookies (
    `cookie` VARCHAR(64),
    `description` VARCHAR(255) DEFAULT '',
    PRIMARY KEY (`cookie`)
);

CREATE TABLE Ingredients (
    `ingredient` VARCHAR(64),
    `quantity` BIGINT UNSIGNED NOT NULL,
    `description` VARCHAR(255) DEFAULT '',
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `lastAddition` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY(`ingredient`)
);

CREATE TABLE Recipies (
    `cookie` VARCHAR(64),
    `ingredient` VARCHAR(64),
    `quantity` BIGINT UNSIGNED NOT NULL, -- grams
    FOREIGN KEY(`cookie`) REFERENCES Cookies(`cookie`),
    FOREIGN KEY(`ingredient`) REFERENCES Ingredients(`ingredient`),
    PRIMARY KEY(`cookie`, `ingredient`)
);

CREATE TABLE Customers (
    `customer` VARCHAR(128),
    `address` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`customer`)
);

CREATE TABLE Orders (
    `order_id` SMALLINT(5) UNSIGNED ZEROFILL AUTO_INCREMENT,
    `customer` VARCHAR(128) NOT NULL,
    `created` DATETIME NOT NULL,
    `deadline` DATE NOT NULL,
    `delivered` DATE,
    FOREIGN KEY (`customer`) REFERENCES Customers (`customer`),
    PRIMARY KEY (`order_id`)
);

-- weak entity, should be able to place an order 
-- on pallets that hasn't yet been produced
CREATE TABLE OrderedPallets (
    `order_id` SMALLINT(5) UNSIGNED NOT NULL,
    `cookie` VARCHAR(64),
    `quantity` BIGINT UNSIGNED,
    FOREIGN KEY (`order_id`) REFERENCES Orders (`order_id`),
    FOREIGN KEY (`cookie`) REFERENCES Cookies (`cookie`),
    PRIMARY KEY (`order_id`,`cookie`, `quantity`)
);

-- produced pallets. before delivery a check should be
-- made that enough pallets are in stock & reserved for
-- that specific order. if so then delivered field in
-- Orders are set. 
CREATE TABLE ProducedPallets (
    `pallet_id` SMALLINT(5) UNSIGNED ZEROFILL AUTO_INCREMENT,
    `order_id` SMALLINT(5) UNSIGNED,
    `cookie` VARCHAR(64) NOT NULL,
    `produced` DATETIME NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES Orders (`order_id`),
    FOREIGN KEY (`cookie`) REFERENCES Cookies (`cookie`),
    PRIMARY KEY (`pallet_id`)
);

CREATE TABLE Blocked (
    `block_id` SMALLINT(5) UNSIGNED ZEROFILL AUTO_INCREMENT,
    `cookie` VARCHAR(64) NOT NULL,
    `start` DATE NOT NULL,
    `end` DATE NOT NULL,
    UNIQUE (`cookie`, `start`, `end`),
    FOREIGN KEY (`cookie`) REFERENCES Cookies (`cookie`),
    PRIMARY KEY (`block_id`)
);

INSERT INTO Cookies (`cookie`) VALUES
('Nut ring'),
('Nut cookie'),
('Amneris'),
('Tango'),
('Almond delight'),
('Berliner');

INSERT INTO Ingredients (`ingredient`, `quantity`, `lastAddition`) VALUES
('Butter', 10000, 0),
('Sugar', 10000, 0),
('Chopped almonds', 10000, 0),
('Flour', 10000, 0),
('Cinnamon', 10000, 0),
('Icing sugar', 10000, 0),
('Eggs', 10000, 0),
('Vanilla sugar', 10000, 0),
('Chocolate', 10000, 0),
('Vanilla', 10000, 10000),
('Sodium bicarbonate', 10000, 0),
('Wheat flour', 10000, 0),
('Potato starch', 10000, 0),
('Marzipan', 10000, 0),
('Egg whites', 10000, 0),
('Bread crumbs', 10000, 0),
('Fine-ground nuts', 10000, 0),
('Ground, roasted nuts', 10000, 0),
('Roasted, chopped nuts', 10000, 0);

INSERT INTO Recipies VALUES
('Nut ring', 'Flour', 450),
('Nut ring', 'Butter', 450),
('Nut ring', 'Icing sugar', 190),
('Nut ring', 'Roasted, chopped nuts', 225),
('Nut cookie', 'Fine-ground nuts', 750),
('Nut cookie', 'Ground, roasted nuts', 625),
('Nut cookie', 'Bread crumbs', 125),
('Nut cookie', 'Sugar', 375),
('Nut cookie', 'Egg whites', 1800),
('Nut cookie', 'Chocolate', 50),
('Amneris', 'Marzipan', 750 ),
('Amneris', 'Butter', 250 ),
('Amneris', 'Eggs', 250 ),
('Amneris', 'Potato starch', 25 ),
('Amneris', 'Wheat flour', 25 ),
('Tango', 'Butter', 200 ),
('Tango', 'Sugar', 250 ),
('Tango', 'Flour', 300 ),
('Tango', 'Sodium bicarbonate', 4 ),
('Tango', 'Vanilla', 2 ),
('Almond delight', 'Butter', 350 ),
('Almond delight', 'Sugar', 270 ),
('Almond delight', 'Chopped almonds', 279 ),
('Almond delight', 'Flour', 400 ),
('Almond delight', 'Cinnamon', 10 ),
('Berliner', 'Flour', 350 ),
('Berliner', 'Butter', 250 ),
('Berliner', 'Icing sugar', 100 ),
('Berliner', 'Eggs', 50 ),
('Berliner', 'Vanilla sugar', 5 ),
('Berliner', 'Chocolate', 50 );

INSERT INTO Blocked VALUES
(NULL, 'Nut ring', CURDATE(), CURDATE() + INTERVAL 1 DAY);

INSERT INTO Customers VALUES
('Finkakor AB', 'Helsingborg'),
('Småbröd AB', 'Malmö'),
('Kaffebröd AB', 'Landskrona'),
('Bjudkakor AB', 'Ystad'),
('Kalaskakor AB', 'Trelleborg'),
('Partykakor AB', 'Kristianstad'),
('Gästkakor AB', 'Hässleholm'),
('Skånekakor AB', 'Perstorp');

-- place two orders
INSERT INTO Orders VALUES
(NULL, 'Finkakor AB', NOW(), CURDATE() + INTERVAL 2 DAY, NULL);

-- specify how many pallets of each cookie the first order refers to
INSERT INTO OrderedPallets VALUES
(00001, 'Nut cookie', 7),
(00001, 'Tango', 4),
(00001, 'Berliner', 2);

-- produce some yummy cookies
INSERT INTO ProducedPallets VALUES
(NULL, NULL, 'Nut ring', NOW()),
(NULL, NULL, 'Nut ring', NOW() + INTERVAL 4 DAY),
(NULL, NULL, 'Nut ring', NOW() + INTERVAL 4 DAY),
(NULL, NULL, 'Nut ring', NOW()),
(NULL, NULL, 'Nut ring', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Nut cookie', NOW()),
(NULL, NULL, 'Amneris', NOW()),
(NULL, NULL, 'Amneris', NOW()),
(NULL, NULL, 'Amneris', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Tango', NOW()),
(NULL, NULL, 'Almond delight', NOW()),
(NULL, NULL, 'Almond delight', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW()),
(NULL, NULL, 'Berliner', NOW());


-- -- Get the name and address of the customer that placed order 1
-- SELECT customer, address FROM Orders INNER JOIN Customers USING (customer) WHERE order_id = 1;
-- 
-- -- Get the number of available Pallets in stock 
-- SELECT cookie, COUNT(*) FROM Pallets WHERE order_id IS NULL GROUP BY cookie;
-- 
-- -- Get all pallets that contain blocked cookies
-- SELECT cookie, COUNT(*) FROM Pallets INNER JOIN Blocked USING (cookie) WHERE produced BETWEEN start AND end GROUP BY cookie;
