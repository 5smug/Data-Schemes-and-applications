-- Twin Cities Database Schema
-- Run this first to create all tables

-- Drop tables if they exist (in correct order due to foreign keys)
DROP TABLE IF EXISTS PhotoSet;
DROP TABLE IF EXISTS photos;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS place_of_interest;
DROP TABLE IF EXISTS city;

-- Create CITY table
CREATE TABLE city (
    City_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(45) NOT NULL,
    Country VARCHAR(45) NOT NULL,
    Population INT,
    Weather VARCHAR(100),
    Currency VARCHAR(45),
    Lon DECIMAL(9,6),
    Lat DECIMAL(9,6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create PLACE_OF_INTEREST table
CREATE TABLE place_of_interest (
    POI_ID INT AUTO_INCREMENT PRIMARY KEY,
    City_ID INT NOT NULL,
    StreetName VARCHAR(45),
    Postcode VARCHAR(10),
    NameofLocation VARCHAR(100) NOT NULL,
    Lon DECIMAL(9,6),
    Lat DECIMAL(9,6),
    Place_Description VARCHAR(150),
    FOREIGN KEY (City_ID) REFERENCES city(City_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create NEWS table
CREATE TABLE news (
    NewsID INT AUTO_INCREMENT PRIMARY KEY,
    City_ID INT NOT NULL,
    Headline VARCHAR(200) NOT NULL,
    Publisher VARCHAR(100),
    Time DATETIME,
    Photo LONGBLOB,
    Body TEXT,
    FOREIGN KEY (City_ID) REFERENCES city(City_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create PHOTOS table
CREATE TABLE photos (
    PhotoID INT AUTO_INCREMENT PRIMARY KEY,
    PhotoSetID INT,
    Photo LONGBLOB,
    PhotoName VARCHAR(100),
    Description VARCHAR(200),
    Time DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create PHOTOSET junction table
CREATE TABLE PhotoSet (
    PhotoSetID INT AUTO_INCREMENT PRIMARY KEY,
    Place_of_InterestID INT NOT NULL,
    PhotoID INT NOT NULL,
    FOREIGN KEY (Place_of_InterestID) REFERENCES place_of_interest(Place_of_InterestID) ON DELETE CASCADE,
    FOREIGN KEY (PhotoID) REFERENCES photos(PhotoID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;