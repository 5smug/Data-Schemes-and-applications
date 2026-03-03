INSERT INTO city (Name, Country, Population, Weather, Currency, Lon, Lat) VALUES
('London', 'United Kingdom', 8982000, 'Temperate', 'GBP', -0.127647, 51.507322);
INSERT INTO city (Name, Country, Population, Weather, Currency, Lon, Lat) VALUES
('New York City', 'United States', 8419000, 'Humid subtropical', 'USD', -74.006015, 40.712776);

-- Places for London
INSERT INTO place_of_interest (City_ID, StreetName, Postcode, NameofLocation, Lon, Lat, Place_Description) VALUES
(1, 'Westminster Bridge Rd', 'SE1 7PB', 'London Eye', -0.119522, 51.503324, 'Giant Ferris wheel on the South Bank'),
(1, 'Westminster', 'SW1A 0AA', 'Big Ben', -0.124625, 51.500729, 'Great Clock of Westminster'),
(1, 'Tower Hill', 'EC3N 4AB', 'Tower of London', -0.076067, 51.508112, 'Historic castle and former prison'),
(1, 'Buckingham Palace Rd', 'SW1A 1AA', 'Buckingham Palace', -0.141890, 51.501476, 'Official residence of the monarch'),
(1, 'Wembley Park', 'HA9 0WS', 'Wembley Stadium', -0.279549, 51.556021, 'National stadium with 90,000 capacity'),
(1, 'Cromwell Rd', 'SW7 5BD', 'Natural History Museum', -0.176707, 51.496510, 'Museum with dinosaur skeletons');

-- Places for NYC
INSERT INTO place_of_interest (City_ID, StreetName, Postcode, NameofLocation, Lon, Lat, Place_Description) VALUES
(2, 'Liberty Island', 'NY 10004', 'Statue of Liberty', -74.044502, 40.689247, 'Iconic national monument'),
(2, '20 W 34th St', 'NY 10118', 'Empire State Building', -73.985656, 40.748817, 'Famous skyscraper with observatory'),
(2, 'Central Park', 'NY 10022', 'Central Park', -73.966545, 40.782865, 'Urban park with lakes and trails'),
(2, 'Pennsylvania Plaza', 'NY 10001', 'Madison Square Garden', -73.993397, 40.750500, 'Famous sports and entertainment venue'),
(2, '89th St and East Dr', 'NY 10028', 'Metropolitan Museum of Art', -73.963203, 40.779479, 'Massive art museum with 2 million works'),
(2, '1 MetLife Stadium Dr', 'NJ 07073', 'MetLife Stadium', -74.074459, 40.813507, 'NFL stadium seating 82,500');

-- News, a simple test
INSERT INTO news (City_ID, Headline, Publisher, Time, Body) VALUES
(1, 'London Eye Celebrates 25th Anniversary', 'London Tourism', NOW(), 'The London Eye marks 25 years as one of the capital''s most popular attractions.'),
(2, 'New Exhibition Opens at Met Museum', 'NY Arts', NOW(), 'The Metropolitan Museum of Art unveils a new collection of modern masters.');