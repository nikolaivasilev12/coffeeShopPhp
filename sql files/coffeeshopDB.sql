DROP DATABASE IF EXISTS coffeeshopDB;
CREATE DATABASE coffeeshopDB;
USE coffeeshopDB;

--Change accordingly once Soren approves our schema

CREATE TABLE PRODUCT
(
    `genreID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL
);

CREATE TABLE CATEGORY
(
    `movieID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `length` INT NULL,
    `rating` FLOAT NULL,
    `genre` INT NULL,
    FOREIGN KEY (genre) REFERENCES MovieGenre(genreID)
);

CREATE TABLE CUSTOMER
(
    `actorID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `gender` CHAR NULL,
    `dateOfBirth` DATE,
    `fname` VARCHAR (100) NOT NULL,
    `lname` VARCHAR (255) NOT NULL
);

CREATE TABLE ActorAppearsIn
(
     `recID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
     `actorID` INT NULL,
     `movieID` INT NULL,
      FOREIGN KEY (actorID) REFERENCES Actor(actorID),
      FOREIGN KEY (movieID) REFERENCES Movie (movieID)
);


INSERT INTO MovieGenre (genreID, name, description) VALUES (NULL, 'Action', 'Action Description');
INSERT INTO Movie (movieID, name, length, rating, genre) VALUES (NULL, 'INCEPTION', 230, 7.5, 1);
INSERT INTO Actor (actorID, gender, dateOfBirth, fname, lname) VALUES (NULL, 'M', '11-11-1974', 'Leaondardo', 'DiCaprio');
INSERT INTO ActorAppearsIn (recID, actorID, movieID) VALUES (NULL, 1, 1);