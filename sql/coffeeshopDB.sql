DROP DATABASE IF EXISTS coffeeshopDB;
CREATE DATABASE coffeeshopDB;
USE coffeeshopDB;


CREATE TABLE CUSTOMER
(
    `customerID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `email` CHAR(255) NOT NULL,
    `password` VARCHAR(250) NOT NULL,
    `fname` VARCHAR(255) NOT NULL,
    `lname` VARCHAR (255) NOT NULL,
    `phoneNr` CHAR(11) NOT NULL
);

CREATE TABLE PRODUCT
(
    `productID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR (255) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `stock` BOOLEAN NOT NULL,
    `origin` VARCHAR (255) NOT NULL,
    `type` VARCHAR (255) NOT NULL,
    `isSpecial` BOOLEAN NULL
);

CREATE TABLE POSTALCODE
(
    `postalCode` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `city` VARCHAR(255) NOT NULL
);

CREATE TABLE ADRESS
(
    `adressID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `street` VARCHAR(255) NOT NULL,
    postalCode INT NOT NULL,
    FOREIGN KEY (postalCode) REFERENCES POSTALCODE(postalCode)
);

CREATE TABLE `ORDER`
(
    `orderID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    customerID INT NOT NULL,
    adressID INT NOT NULL,
    `date` DATETIME NOT NULL,
    FOREIGN KEY (customerID) REFERENCES CUSTOMER (customerID),
    FOREIGN KEY (adressID) REFERENCES ADRESS (adressID)
);

CREATE TABLE `ORDERHASPRODUCT`
(
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `price` DECIMAL(10,2) NOT NULL,
    `productID` INT NOT NULL,
    `amount` INT NOT NULL,
    `orderID` INT NOT NULL,
    FOREIGN KEY (productID) REFERENCES PRODUCT (productID),
    FOREIGN KEY (orderID) REFERENCES `ORDER` (orderID)
);

CREATE TABLE CATEGORY
(
    `categoryID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `description` TEXT
);

CREATE TABLE PRODUCTHASCATEGORY
(
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    productID INT NOT NULL,
    categoryID INT NOT NULL,
    FOREIGN KEY (productID) REFERENCES PRODUCT(productID),
    FOREIGN KEY (categoryID) REFERENCES CATEGORY(categoryID)
);

CREATE TABLE RATING
(
    `ratingID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    productID INT NOT NULL,
    customerID INT NOT NULL,
    `ratingValue` INT NOT NULL,
    FOREIGN KEY (productID) REFERENCES PRODUCT (productID),
    FOREIGN KEY (customerID) REFERENCES CUSTOMER (customerID)
);

CREATE TABLE COMPANYDATA
(
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `companyDescription` TEXT,
    `adress` VARCHAR(255),
    `phone` INT,
    `email` VARCHAR(255)
);

CREATE TABLE WORKDAYS
(
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `startingHour` DATETIME,
    `closingHour` DATETIME,
    `openDay` VARCHAR(255)
);

CREATE TABLE NEWS
(
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `content` TEXT,
    `date` DATETIME
);


-- Customer
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('fludovico0@hp.com', 'wBNDeBzreW', 'Frank', 'Ludovico', '948-602-7488');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('nharkin1@mediafire.com', 'hleuL7mbA', 'Norean', 'Harkin', '794-557-0884');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('gdelucia2@drupal.org', 'gdxqT1g8i', 'Goldia', 'Delucia', '600-107-6051');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('kgillard3@cbslocal.com', 'vIfARV3JJb', 'Kizzie', 'Gillard', '162-322-0203');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('olamonby4@yandex.ru', 'wMgWfnJrw', 'Ozzie', 'Lamonby', '779-126-2506');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('tpearcey5@yandex.ru', '5GMiut', 'Tova', 'Pearcey', '986-132-1958');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('scheshire6@seesaa.net', 'iKNRMJ7', 'Selena', 'Cheshire', '201-239-1993');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('rpiddington7@unicef.org', 'Lnltyk', 'Rafferty', 'Piddington', '208-714-4124');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('drubenczyk8@delicious.com', 'p0sIkGBCxp', 'Daven', 'Rubenczyk', '974-471-2436');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('dcunney9@discuz.net', '38Pbt1h', 'Dyana', 'Cunney', '199-398-0068');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('dbomba@amazon.co.uk', 'WIGbRl2tcrh', 'Dolf', 'Bomb', '895-922-9585');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('bkinnerkb@drupal.org', 'rwpRBW9GGe', 'Berti', 'Kinnerk', '218-571-8572');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('ppettifordc@fastcompany.com', 'juCr7efv', 'Pepi', 'Pettiford', '341-540-1443');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('bledamund@ucla.edu', 'QDHi8FTVlMH', 'Bentley', 'Ledamun', '149-694-1052');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('rwheildone@feedburner.com', 'xgrIbb', 'Rayna', 'Wheildon', '325-535-6569');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('krudigerf@nasa.gov', 'QdNkcFC8EDb', 'Kenna', 'Rudiger', '127-621-1776');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('nescofierg@hao123.com', 'a5uQEC6njNzH', 'Noll', 'Escofier', '711-254-8837');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('jmacevillyh@tamu.edu', 'IuK5h25', 'Johnnie', 'MacEvilly', '616-724-1665');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('tpilleri@scientificamerican.com', 'ulPbqQ3', 'Theodora', 'Piller', '331-647-0092');
insert into CUSTOMER (email, password, fname, lname, phoneNr) values ('klaiblej@answers.com', '0lLDJvG1PU', 'Kirstin', 'Laible', '308-757-4382');

-- PRODUCT
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Konklux', 'ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula', 112.47, false, 'China', 'instruction set', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Tres-Zap', 'morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem', 144.87, false, 'China', 'global', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Voltsillam', 'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis', 52.38, false, 'Venezuela', 'mission-critical', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Pannier', 'ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo', 237.46, true, 'Czech Republic', 'Centralized', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Cookley', 'amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo', 137.52, true, 'Bolivia', 'process improvement', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Hatity', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec', 80.29, true, 'Philippines', 'Optional', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Flowdesk', 'nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit nec', 7.57, true, 'Cameroon', 'secured line', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Ventosanzap', 'integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent', 235.0, false, 'Sweden', 'extranet', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Flowdesk', 'et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis', 278.4, true, 'Canada', 'Innovative', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Home Ing', 'vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat', 243.12, true, 'Nigeria', 'capability', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Trippledex', 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque', 61.46, true, 'Indonesia', 'Front-line', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Cardguard', 'ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', 206.74, true, 'Indonesia', 'Graphic Interface', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Trippledex', 'quisque arcu libero rutrum ac lobortis vel dapibus at diam nam tristique tortor eu', 298.96, false, 'China', 'workforce', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Stringtough', 'orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis', 23.23, false, 'Philippines', 'Monitored', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Konklux', 'ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui', 120.13, true, 'Brazil', 'analyzing', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Veribet', 'molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque', 185.46, false, 'Cameroon', 'matrices', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Solarbreeze', 'velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus', 259.0, true, 'Netherlands', 'conglomeration', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Ronstring', 'morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis', 198.51, true, 'Greece', 'Implemented', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Lotstring', 'ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla', 280.44, false, 'Portugal', 'static', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Matsoft', 'vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', 88.7, false, 'China', 'User-centric', false);

-- POSTALCODE
insert into POSTALCODE (city) values ('Zouma');
insert into POSTALCODE (city) values ('Maliuzui');
insert into POSTALCODE (city) values ('Okigwi');
insert into POSTALCODE (city) values ('Muara');
insert into POSTALCODE (city) values ('Auna');
insert into POSTALCODE (city) values ('Xiangdian');
insert into POSTALCODE (city) values ('Manzurka');
insert into POSTALCODE (city) values ('Shiliting');
insert into POSTALCODE (city) values ('Karanganyar');
insert into POSTALCODE (city) values ('Galán');
insert into POSTALCODE (city) values ('Shibushi');
insert into POSTALCODE (city) values ('Kanada');
insert into POSTALCODE (city) values ('Lianzhou');
insert into POSTALCODE (city) values ('Metz');
insert into POSTALCODE (city) values ('Qui Nhon');
insert into POSTALCODE (city) values ('Yaguaraparo');
insert into POSTALCODE (city) values ('Dabagou');
insert into POSTALCODE (city) values ('Kuluran');
insert into POSTALCODE (city) values ('Torsås');
insert into POSTALCODE (city) values ('Chicago');

-- ADRESS

insert into ADRESS (postalCode, street) values (1, '62147 Sycamore Drive');
insert into ADRESS (postalCode, street) values (2, '67214 Burrows Place');
insert into ADRESS (postalCode, street) values (3, '67342 Paget Junction');
insert into ADRESS (postalCode, street) values (4, '9 Loomis Center');
insert into ADRESS (postalCode, street) values (5, '3391 Sunfield Junction');
insert into ADRESS (postalCode, street) values (6, '97073 Elgar Plaza');
insert into ADRESS (postalCode, street) values (7, '5996 2nd Way');
insert into ADRESS (postalCode, street) values (8, '904 Sunbrook Point');
insert into ADRESS (postalCode, street) values (9, '4542 Lunder Way');
insert into ADRESS (postalCode, street) values (10, '36182 Atwood Crossing');
insert into ADRESS (postalCode, street) values (11, '5 Victoria Parkway');
insert into ADRESS (postalCode, street) values (12, '02836 Briar Crest Circle');
insert into ADRESS (postalCode, street) values (13, '9739 Butterfield Plaza');
insert into ADRESS (postalCode, street) values (14, '626 Clove Place');
insert into ADRESS (postalCode, street) values (15, '2753 Kinsman Crossing');
insert into ADRESS (postalCode, street) values (16, '8963 Village Green Junction');
insert into ADRESS (postalCode, street) values (17, '15 Bonner Place');
insert into ADRESS (postalCode, street) values (18, '463 Mariners Cove Circle');
insert into ADRESS (postalCode, street) values (19, '3308 Morning Parkway');
insert into ADRESS (postalCode, street) values (20, '22348 Meadow Vale Hill');

-- `Order`
insert into `ORDER` (customerID, adressID, `date`) values (1, 1, '2020-04-05 03:25:19');
insert into `ORDER` (customerID, adressID, `date`) values (2, 2, '2020-07-30 11:37:24');
insert into `ORDER` (customerID, adressID, `date`) values (3, 3, '2020-08-28 14:51:11');
insert into `ORDER` (customerID, adressID, `date`) values (4, 4, '2020-07-20 08:04:16');
insert into `ORDER` (customerID, adressID, `date`) values (5, 5, '2020-05-11 01:28:33');
insert into `ORDER` (customerID, adressID, `date`) values (6, 6, '2020-02-02 05:43:49');
insert into `ORDER` (customerID, adressID, `date`) values (7, 7, '2020-02-18 22:50:20');
insert into `ORDER` (customerID, adressID, `date`) values (8, 8, '2020-01-23 08:08:42');
insert into `ORDER` (customerID, adressID, `date`) values (9, 9, '2020-07-24 00:47:30');
insert into `ORDER` (customerID, adressID, `date`) values (10, 10, '2020-09-19 21:55:55');
insert into `ORDER` (customerID, adressID, `date`) values (11, 11, '2020-03-26 14:23:49');
insert into `ORDER` (customerID, adressID, `date`) values (12, 12, '2020-02-26 04:44:30');
insert into `ORDER` (customerID, adressID, `date`) values (13, 13, '2020-04-21 10:39:37');
insert into `ORDER` (customerID, adressID, `date`) values (14, 14, '2019-10-08 15:48:53');
insert into `ORDER` (customerID, adressID, `date`) values (15, 15, '2020-06-11 03:40:07');
insert into `ORDER` (customerID, adressID, `date`) values (16, 16, '2020-09-07 17:56:10');
insert into `ORDER` (customerID, adressID, `date`) values (17, 17, '2020-09-18 00:14:48');
insert into `ORDER` (customerID, adressID, `date`) values (18, 18, '2020-02-14 20:28:02');
insert into `ORDER` (customerID, adressID, `date`) values (19, 19, '2020-03-31 07:02:29');
insert into `ORDER` (customerID, adressID, `date`) values (20, 20, '2019-11-25 16:24:33');

-- ORDERHASPRODUCT
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (617.3, 1, 12, 1);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (299.8, 2, 60, 2);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (354.55, 3, 14, 3);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (734.09, 4, 34, 4);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (385.43, 5, 78, 5);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (79.06, 6, 76, 6);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (465.31, 7, 34, 7);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (445.27, 8, 39, 8);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (750.39, 9, 50, 9);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (345.58, 10, 62, 10);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (989.95, 11, 65, 11);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (826.47, 12, 75, 12);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (898.1, 13, 35, 13);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (169.24, 14, 97, 14);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (951.71, 15, 7, 15);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (583.69, 16, 55, 16);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (117.54, 17, 51, 17);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (983.1, 18, 64, 18);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (851.39, 19, 41, 19);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (25.73, 20, 99, 20);

-- Category
insert into CATEGORY (name, description) values ('Documentary', 'Self-enabling eco-centric Graphic Interface');
insert into CATEGORY (name, description) values ('Drama', 'Down-sized background paradigm');
insert into CATEGORY (name, description) values ('Horror', 'Reactive responsive budgetary management');
insert into CATEGORY (name, description) values ('Action', 'Sharable content-based budgetary management');
insert into CATEGORY (name, description) values ('Romance', 'Synergized fresh-thinking matrix');
insert into CATEGORY (name, description) values ('War', 'Triple-buffered encompassing open system');

-- PRODUCTHASCATEGORY

insert into PRODUCTHASCATEGORY (productID, categoryID) values (1, 1);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (2, 2);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (3, 3);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (4, 4);


-- RATING
insert into RATING (productID, customerID, ratingValue) values (1, 1, 5);
insert into RATING (productID, customerID, ratingValue) values (2, 2, 3);
insert into RATING (productID, customerID, ratingValue) values (3, 3, 4);
insert into RATING (productID, customerID, ratingValue) values (4, 4, 3);
insert into RATING (productID, customerID, ratingValue) values (5, 5, 4);
insert into RATING (productID, customerID, ratingValue) values (6, 6, 2);
insert into RATING (productID, customerID, ratingValue) values (7, 7, 1);
insert into RATING (productID, customerID, ratingValue) values (8, 8, 3);
insert into RATING (productID, customerID, ratingValue) values (9, 9, 2);
insert into RATING (productID, customerID, ratingValue) values (10, 10, 3);

-- COMPANYDATA
insert into COMPANYDATA (companyDescription, adress, phone, email) values ('Enhanced content-based firmware', '9941 Sachtjen Alley', '799-589-5427', 'calkin0@bigcartel.com');

-- WORKDAYS
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2019-12-01 19:21:31', '2019-10-25 12:14:46', 'Monday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2019-10-18 20:25:05', '2020-05-02 13:06:39', 'Tuesday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2019-12-22 23:36:44', '2020-03-20 22:46:15', 'Wednesday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2019-11-02 08:28:54', '2020-08-18 20:07:47', 'Thursday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2020-09-24 05:17:15', '2020-08-25 13:23:35', 'Friday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2020-10-01 10:19:07', '2020-05-28 20:17:30', 'Saturday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('2020-03-16 23:22:14', '2020-07-02 12:54:00', 'Sunday');

-- NEWS
insert into NEWS (content, date) values (' I am da news part yo. Pellentesque ultrices mattis odio.', '2020-09-15 15:24:35');