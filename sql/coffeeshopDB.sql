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
    `phoneNr` CHAR(11) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `stripeID` VARCHAR(255)
);

CREATE TABLE PERMISSION
(
    `permissionID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR (25) NOT NULL
);

CREATE TABLE `CUSTOMER_PERMISSION`
(
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `customerID` INT NOT NULL,
    `permissionID` INT NOT NULL,
    FOREIGN KEY (customerID) REFERENCES customer (customerID),
    FOREIGN KEY (permissionID) REFERENCES permission (permissionID)
);

CREATE TABLE PRODUCT
(
    `productID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR (800) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `stock` TINYINT(255) NOT NULL,
    `origin` VARCHAR (255) NOT NULL,
    `type` VARCHAR (255) NOT NULL,
    `isSpecial` BOOLEAN NULL
);

CREATE TABLE `IMAGE`
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    productID INT NOT NULL,
    FOREIGN KEY(productID) REFERENCES `product`(productID)
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
    adressID INT,
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
    `phone` VARCHAR(255),
    `email` VARCHAR(255)
);

CREATE TABLE WORKDAYS
(
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `startingHour` VARCHAR(5),
    `closingHour` VARCHAR(5),
    `openDay` VARCHAR(255)
);

CREATE TABLE NEWS
(
    `ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `content` TEXT,
    `date` DATETIME
);


-- Customer
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('fludovico0@hp.com', 'wBNDeBzreW', 'Frank', 'Ludovico', '948-602-7488', 'dogman');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('nharkin1@mediafire.com', 'hleuL7mbA', 'Norean', 'Harkin', '794-557-0884', 'mahdewd');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('gdelucia2@drupal.org', 'gdxqT1g8i', 'Goldia', 'Delucia', '600-107-6051', 'howboi');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('kgillard3@cbslocal.com', 'vIfARV3JJb', 'Kizzie', 'Gillard', '162-322-0203', 'cawboi69');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('olamonby4@yandex.ru', 'wMgWfnJrw', 'Ozzie', 'Lamonby', '779-126-2506', 'turtoise15');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('tpearcey5@yandex.ru', '5GMiut', 'Tova', 'Pearcey', '986-132-1958', 'coolguy89');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('scheshire6@seesaa.net', 'iKNRMJ7', 'Selena', 'Cheshire', '201-239-1993', 'sadboi46');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('rpiddington7@unicef.org', 'Lnltyk', 'Rafferty', 'Piddington', '208-714-4124', 'poshman15');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('drubenczyk8@delicious.com', 'p0sIkGBCxp', 'Daven', 'Rubenczyk', '974-471-2436', 'coffeelover12');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('dcunney9@discuz.net', '38Pbt1h', 'Dyana', 'Cunney', '199-398-0068', 'coffeehater15');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('dbomba@amazon.co.uk', 'WIGbRl2tcrh', 'Dolf', 'Bomb', '895-922-9585', 'trump4president16');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('bkinnerkb@drupal.org', 'rwpRBW9GGe', 'Berti', 'Kinnerk', '218-571-8572', 'makeamericagreat');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('ppettifordc@fastcompany.com', 'juCr7efv', 'Pepi', 'Pettiford', '341-540-1443', 'freecoffee');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('bledamund@ucla.edu', 'QDHi8FTVlMH', 'Bentley', 'Ledamun', '149-694-1052', 'covfefe');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('rwheildone@feedburner.com', 'xgrIbb', 'Rayna', 'Wheildon', '325-535-6569', 'iluvcoffee');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('krudigerf@nasa.gov', 'QdNkcFC8EDb', 'Kenna', 'Rudiger', '127-621-1776', 'supahduppaman');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('nescofierg@hao123.com', 'a5uQEC6njNzH', 'Noll', 'Escofier', '711-254-8837', 'chickmagnet96');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('jmacevillyh@tamu.edu', 'IuK5h25', 'Johnnie', 'MacEvilly', '616-724-1665', 'superduper');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('tpilleri@scientificamerican.com', 'ulPbqQ3', 'Theodora', 'Piller', '331-647-0092', 'barbiegirl');
insert into CUSTOMER (email, password, fname, lname, phoneNr, username) values ('klaiblej@answers.com', '0lLDJvG1PU', 'Kirstin', 'Laible', '308-757-4382', 'superuniquename');

-- PERMISSION
insert into PERMISSION (`name`) values ('customer');
insert into PERMISSION (`name`) values ('admin');

-- CUSTOMER PERMISSION
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('1', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('2', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('3', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('4', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('5', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('6', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('7', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('8', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('9', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('10', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('11', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('12', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('13', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('14', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('15', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('16', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('17', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('18', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('19', '1');
insert into CUSTOMER_PERMISSION (customerID, permissionID) values ('20', '1');

-- PRODUCT
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('After Dinner Blend Coffee Beans', 'Savor the unique full-bodied taste of Yirgacheffe coffee beans with their chocolaty undertones and smooth, sweet finish. Africa’s Ethiopian coffees are revered for their amazing sweet fruity flavor.', 990.99, 42, 'Ethiopia', 'Black coffee', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Breakfast Blend Coffee', 'Are you looking for that perfect morning boost of energy to help you along? If so, then you’ll want to try our Breakfast Blend Coffee!', 250.99, 43, 'China', 'Americano', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Connoisseur Blend Coffee Beans', 'Connoisseur Blend is a distinctive blend of the best Arabian, African and Indonesian coffees. You don’t have to be an expert on gourmet coffee to appreciate the art and technique of this exceptional cup. ', 190.99, 15, 'Tanzania', 'Doppio', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Dutch Trader Coffee Beans', 'Over four centuries ago Dutch explorers set out to achieve power and riches through Indonesia’s commodity market. Hundreds of entrepreneurs discovered gourmet coffee beans that showcase unique attributes such as earthiness, rich flavors and spicy overtones.', 200, 1, 'Dutch', 'Cortado', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet E-Coffee Blend ', 'E-Coffee Blend is an underground sensation that includes a combination of three Arabica gourmet coffee beans, blended and roasted to perfection. Our top secret blend has a dark color, soothing aroma and a smooth finish.', 190.99, 4, 'Bolivia', 'Red-Eye', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Italian Roast Coffee Blend ', 'Italian Blend is a commanding blend of Central American and Indonesian coffees, Italian roasted to perfection by expert roast masters. Gather these gourmet Coffee Beans into your hand and see how they shine like little black gems; and the taste!', 150.99, 1, 'Italy', 'Lungo', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Jamaican Blue Cuvee', 'Jamaican Blue Cuvee Blend is an unparalleled gourmet coffee with a taste, texture and aroma that coffee lovers treasure. Why blend authentic Jamaican Blue Mountain with other gourmet coffee beans? Roast masters will tell you it’s because blending allows you to soar above what single origin gourmet coffee beans have to offer.', 390.99, 1, 'Jamaica', 'Black', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Kona Coffee Blend', 'It is this combination of rarity, unique growing conditions and exceptional taste that has contributed to the elevated status of this unique tasting gourmet coffee.', 390.99, false, 'Hawaii', 'Flat White', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Marrakesh Coffee Beans', 'Marrakesh Blend is a pleasing fusion of medium roasted, highest quality Arabica beans. Gourmet coffee beans are roasted to a velvety smooth finish for a mix of complex flavors and pleasant hint of vanilla.', 300.99, 133, 'Marakesh', 'Latte', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Chicory Coffee', 'With its rich history and traditions, New Orleans was greatly impacted by French culture during its early years. Do you know the full story behind Chicory coffee history? During the Civil War, residents started added ground chicory to their coffee to make their limited coffee rations go further.', 140.99, 24, 'USA', 'Mocha', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet Summer Coffee Blend', 'The best coffee blend for hot summer months! Our Summer Coffee Blend formula starts with hand-blended Brazilian Santos with quality Central and South American Arabica beans. Together these gourmet coffee beans are small batch roasted to the perfect point and come together to create great aroma, a mild caramel flavor!', 170.99, 18, 'South America', 'Black', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Banana Hazelnut Flavored Coffee', 'Banana Hazelnut is one of the more popular sellers because of its burst of banana flavor with the gentle essence of Hazelnut extract. The aroma of this coffee is warm and inviting.', 300.99, 4, 'Indonesia', 'BLACK', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Coconut Cream Flavored Coffee Beans', 'This gourmet flavored coffee has been created especially for all the coconut lovers out there. Pure 100% Arabica coffee beans grown at high elevations are spruced up with natural coconut flavors that create a subtle flavoring without overpowering the taste of gourmet coffee.', 520.99, 3, 'China', 'Black', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Colombian Coffee Beans', 'A BESTSELLER! Colombian coffees are generally wet-processed (the preferred method) and sold by grade as dictated by the Colombian Coffee Federation’s national standards. Only the large, high mountain-grown “supremo beans” are used for our Colombian Supremo La Valle Verde gourmet coffee.', 290.99, 5, 'Columbia', 'Red-Eye', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Decaf Coffeehouse Blend', 'This is the decaffeinated version of our Gourmet House Blend which is an expert combination of Espresso coffee beans and Central and South American coffee beans. We use the strictest decaffeination processes and our House Blend Decaf is great!', 210.95, 49, 'Brazil', 'LATTE', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet English Toffee Flavored Coffee Beans', 'Fashioned after true English Toffees, this rich medium roast flavored specialty coffee captures the butter and caramelized sugar tastes of the traditional English confectionery treat. With only 2 calories per cup of brewed English Toffee coffee, this is the perfect way to enjoy flavored coffees while watching your waistline.', 120.99, 0, 'Cameroon', 'Black', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet Ethiopian Coffee', 'A BESTSELLER! Ethiopia is credited as the origin of gourmet mountain grown coffee dating back over 1000 years. Ethiopian coffee beans are grown at elevations over 4000 feet and Ethiopia Yirgacheffe coffee is considered not only the best of east African coffee beans but also one of the world’s finest and most sought after specialty coffees. ', 730.95, 1, 'Africa', 'Black', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Organic Bali ‘Blue Moon’ Green Coffee', 'Unroasted Organic Bali ‘Blue Moon’ Green Coffee', 350.95, 255, 'Greece', 'Black', false);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet Sumatra Coffee – Black Satin Roast', ' Rare and rich in flavor, this premium Indonesian coffee from the Mandheling Province of West Sumatra is highly valued by coffee lovers throughout the world. This Sumatra Black Satin Roast coffee is our best selling dark roast coffee boasting a thick, chocolaty, full-bodied texture with mild earthy notes… a superior cup of coffee.', 290.99, 0, 'Sumatra', 'Black', true);
insert into PRODUCT (name, description, price, stock, origin, type, isSpecial) values ('Gourmet Sumatra Coffee Beans', 'Sumatra is one of the main islands of Indonesia and the premium gourmet coffee beans grown in the Mandheling province on the west coast of Sumatra are considered by many to be among the world’s finest specialty coffees. Expect a heavy, complex syrupy flavor, full-bodied yet with low acidity from our gourmet Sumatra Mandheling coffee beans.', 300.99, 0, 'Indonesia', 'Doppio', false);

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
insert into `ORDER` (customerID,  `date`) values (1, '2020-04-05 03:25:19');
insert into `ORDER` (customerID,  `date`) values (2, '2020-07-30 11:37:24');
insert into `ORDER` (customerID,  `date`) values (3, '2020-08-28 14:51:11');
insert into `ORDER` (customerID,  `date`) values (4, '2020-07-20 08:04:16');
insert into `ORDER` (customerID,  `date`) values (5, '2020-05-11 01:28:33');
insert into `ORDER` (customerID,  `date`) values (6, '2020-02-02 05:43:49');
insert into `ORDER` (customerID,  `date`) values (7, '2020-02-18 22:50:20');
insert into `ORDER` (customerID,  `date`) values (8, '2020-01-23 08:08:42');
insert into `ORDER` (customerID,  `date`) values (9, '2020-07-24 00:47:30');
insert into `ORDER` (customerID,  `date`) values (10, '2020-09-19 21:55:55');
insert into `ORDER` (customerID,  `date`) values (11, '2020-03-26 14:23:49');
insert into `ORDER` (customerID,  `date`) values (12, '2020-02-26 04:44:30');
insert into `ORDER` (customerID,  `date`) values (13, '2020-04-21 10:39:37');
insert into `ORDER` (customerID,  `date`) values (14, '2019-10-08 15:48:53');
insert into `ORDER` (customerID,  `date`) values (15, '2020-06-11 03:40:07');
insert into `ORDER` (customerID,  `date`) values (16, '2020-09-07 17:56:10');
insert into `ORDER` (customerID,  `date`) values (17, '2020-09-18 00:14:48');
insert into `ORDER` (customerID,  `date`) values (18, '2020-02-14 20:28:02');
insert into `ORDER` (customerID,  `date`) values (19, '2020-03-31 07:02:29');
insert into `ORDER` (customerID,  `date`) values (20, '2019-11-25 16:24:33');

-- ORDERHASPRODUCT
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (60, 1, 12, 1);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (80, 2, 60, 2);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (20.99, 3, 14, 3);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (19.99, 4, 34, 4);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (34.99, 5, 78, 5);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (99.99, 6, 76, 6);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (78.99, 7, 34, 7);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (55, 8, 39, 8);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (39.99, 9, 50, 9);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (40, 10, 62, 10);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (50.99, 11, 65, 11);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (15.99, 12, 75, 12);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (19.99, 13, 35, 13);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (17.59, 14, 97, 14);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (16.99, 15, 7, 15);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (36.99, 16, 55, 16);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (8.99, 17, 51, 17);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (12.95, 18, 64, 18);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (14.99, 19, 41, 19);
insert into `ORDERHASPRODUCT` (price, productID, amount, orderID) values (20, 20, 99, 20);

-- Category
insert into CATEGORY (name, description) values ('Organic Beans', 'Our gourmet natural organic coffee beans are prepared by certified Organic Coffee Handlers and Processors to ensure the high standards established by the National Organic Program are met. Rest assured that your natural organic coffee beans are from environmentally friendly farms that protect the environment by abstaining from harmful chemicals and pesticides.');
insert into CATEGORY (name, description) values ('Gourmet Coffee Beans', 'We offer only the best gourmet coffee beans making it possible for you to bring a world of gourmet coffee into the comfort of your own home or office.');
insert into CATEGORY (name, description) values ('Decaf Beans', 'Whether you appreciate the health benefits of decaf coffee or need decaf coffee beans so you can sleep at night you don’t want to compromise on taste or quality. Our gourmet decaf coffee beans are roasted with special care to ensure you get an even roast and the best decaf coffee with indistinguishable taste differences.');
insert into CATEGORY (name, description) values ('Coffee Blends', 'Why choose a gourmet coffee blend? Blending gourmet coffee is an art. Creating a unique fresh roasted gourmet coffee bean blend allows us to unify the acidity, flavor, fruity taste and silky, full bodied qualities of different gourmet Coffee Beans.');
insert into CATEGORY (name, description) values ('Flavored Coffee', 'No coffee lover can resist a cup of specialty coffee featuring all time favorite flavored coffees such as Vanilla Cream, Hazelnut, Amaretto, Irish Cream and Almond. Our gourmet flavored coffee products start with only the best 100% Arabica coffee beans grown at high altitudes.');
insert into CATEGORY (name, description) values ('Green Coffee', 'Some coffee lovers prefer to take a more hands-on approach to make sure their morning coffee is absolutely perfect, right down to the roast. For those who enjoy roasting their own coffees at home, we have a wide selection of unroasted green coffee beans to choose from.');

-- PRODUCTHASCATEGORY

insert into PRODUCTHASCATEGORY (productID, categoryID) values (1, 1);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (2, 2);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (3, 1);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (4, 2);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (5, 1);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (6, 2);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (7, 3);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (8, 3);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (9, 3);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (10, 3);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (11, 4);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (12, 4);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (13, 4);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (14, 5);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (15, 5);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (16, 5);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (17, 6);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (18, 6);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (19, 6);
insert into PRODUCTHASCATEGORY (productID, categoryID) values (20, 6);


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
insert into COMPANYDATA (companyDescription, adress, phone, email) values ('Espresso House is a Swedish coffee chain owned by JAB Holding Company. We are passionate about coffee, people and the environment - and to create the worlds best coffee experience for the worlds best guest. With such an ambition, one must be able to offer really good coffee in a cozy environment. ', 'Bohrs 6 Vej, Esbjerg 6700, Denmark', '+45 799589574', 'coffee@shop.com');

-- WORKDAYS
insert into WORKDAYS (startingHour, closingHour, openDay) values ('07:00', '19:00', 'Monday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('07:00', '19:00', 'Tuesday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('07:00', '19:00', 'Wednesday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('07:00', '19:00', 'Thursday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('07:00', '19:00', 'Friday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('10:00', '15:00', 'Saturday');
insert into WORKDAYS (startingHour, closingHour, openDay) values ('10:00', '15:00', 'Sunday');

-- NEWS
insert into NEWS (content, date) values ('Enjoy better office coffee or order fresh gourmet coffee for home! All our Gourmet Coffee Beans are fresh roasted just prior to shipping so you are guaranteed “fresh”. For a limited time we are offered a discount! Use our discount code: POOR and get 25% off for all our products!', '2020-09-15 15:24:35');


-- CREATE VIEW Products and category their belong to
CREATE VIEW products_and_categories AS
SELECT
product.productID AS product_productID,
product.name AS product_name,
category.categoryID AS category_categoryID,
category.name AS category_name,
producthascategory.productID, producthascategory.categoryID
FROM product, category, producthascategory
WHERE product.productID = producthascategory.productID
AND
category.categoryID = producthascategory.categoryID;

-- CREATE Account Roles and Permissions

CREATE VIEW customer_roles_and_permissions AS
SELECT
customer.customerID AS customer_ID,
customer.username AS customer_USERNAME,
permission.permissionID AS permission_ID,
permission.name AS permission_NAME,
customer_permission.customerID,
customer_permission.permissionID
FROM customer, permission, customer_permission
WHERE customer.customerID = customer_permission.customerID
AND
permission.permissionID = customer_permission.permissionID;

-- TRIGGER


