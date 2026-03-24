CREATE DATABASE IF NOT EXISTS tuesday_assigment;
USE tuesday_assigment;

CREATE TABLE IF NOT EXISTS city (
    City_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(45) NOT NULL,
    Country VARCHAR(45) NOT NULL,
    Population INT,
    Weather VARCHAR(100),
    Currency VARCHAR(45),
    Lon DECIMAL(9,6),
    Lat DECIMAL(9,6)
);

CREATE TABLE IF NOT EXISTS place_of_interest (
    Place_of_InterestID INT PRIMARY KEY AUTO_INCREMENT,
    StreetName VARCHAR(45),
    Postcode VARCHAR(15),
    NameofLocation VARCHAR(100) NOT NULL,
    Lon DECIMAL(9,6),
    Lat DECIMAL(9,6),
    Place_Description VARCHAR(250),
    City_ID INT,
    FOREIGN KEY (City_ID) REFERENCES city(City_ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS news (
    NewsID INT PRIMARY KEY AUTO_INCREMENT,
    Headline VARCHAR(200),
    Link VARCHAR(100),
    Body TEXT,
    City_ID INT,
    PublishTime DATETIME,
    FOREIGN KEY (City_ID) REFERENCES city(City_ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS flickr_photos (
    PhotoID INT PRIMARY KEY AUTO_INCREMENT,
    PlaceName VARCHAR(100),
    FlickrID VARCHAR(100), 
    PhotoURL VARCHAR(255),  
    LastUpdated DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO city (Name, Country, Population, Weather, Currency, Lon, Lat) VALUES 
('London', 'United Kingdom', 8982000, 'Partly cloudy', 'Pounds (£)', -0.1278, 51.5074);

INSERT INTO city (Name, Country, Population, Weather, Currency, Lon, Lat) VALUES 
('New York City', 'United States', 8419000, 'Sunny', 'Dollars ($)', -74.0060, 40.7128);

-- London Places of Interest (The postal code, description and others were taken from gemini.google -> referenced)
INSERT INTO place_of_interest (StreetName, Postcode, NameofLocation, Lon, Lat, Place_Description, City_ID) VALUES
('Westminster', 'SW1A 0AA', 'Big Ben', -0.1246, 51.5007, 'Famous clock tower and symbol of London', 1),
('Bankside', 'SE1 9TG', 'Tower Bridge', -0.0754, 51.5055, 'Iconic combined bascule and suspension bridge', 1),
('Westminster', 'SW1A 1AA', 'Buckingham Palace', -0.1419, 51.5014, 'Official residence of the British monarch', 1),
('South Bank', 'SE1 7PB', 'London Eye', -0.1195, 51.5033, 'Giant Ferris wheel on the South Bank', 1),
('Kensington', 'SW7 2RL', 'Natural History Museum', -0.1764, 51.4967, 'Museum exhibiting natural science collections', 1),
('Tower Hill', 'EC3N 4AB', 'Tower of London', -0.0754, 51.5081, 'Historic castle and UNESCO World Heritage Site', 1);

-- New York City Places of Interest (The postal code, description and others were taken from gemini.google -> referenced)
INSERT INTO place_of_interest (StreetName, Postcode, NameofLocation, Lon, Lat, Place_Description, City_ID) VALUES
('Liberty Island', 'NY 10004', 'Statue of Liberty', -74.0445, 40.6892, 'Iconic symbol of freedom and democracy', 2),
('Central Park', 'NY 10024', 'Central Park', -73.9665, 40.7812, 'Urban park in Manhattan', 2),
('350 5th Ave', 'NY 10118', 'Empire State Building', -73.9857, 40.7484, 'Famous 102-story skyscraper', 2),
('Gansevoort Street', 'NY 10014', 'The High Line', -74.0067, 40.7479, 'Elevated linear park built on a historic freight rail line', 2),
('West 34th Street', 'NY 10001', 'Madison Square Garden', -73.9936, 40.7505, 'Famous sports and entertainment venue', 2),
('63rd Street', 'NY 10065', 'The Metropolitan Museum of Art', -73.9626, 40.7794, 'Largest art museum in the US', 2); 

-- This information is gathered from other sources, such as Google.com/search (google.ai, referenced as gemini)
INSERT INTO news (Headline, Link, Body, City_ID, PublishTime) VALUES 
('London Announces New Cultural Festival', 'https://example.com/london-festival', 'London will host a month-long cultural festival starting next month featuring music, art, and food from around the world.', 1, NOW()),
('NYC Launches Sustainable Transport Initiative', 'https://example.com/nyc-transport', 'New York City announces major investment in cycling infrastructure and electric buses.', 2, NOW());