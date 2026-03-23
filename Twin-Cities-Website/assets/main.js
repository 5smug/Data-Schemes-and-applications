// This function makes it so that the index.php / london.php / nyc.php show the markers information and fetches the correct information
// First function sets the name for, latitute + longitude, and description of the place, making it able to be shown when you press on a marker
// Others are explained below
function initMaps() {
    // This is the first function, I've set the element id to london-map so that javascript can ping the markers onto leaflet
    if (document.getElementById('london-map')) {
        var londonMap = L.map('london-map').setView([51.5074, -0.1278], 12);
        // This is a overview of the map from openstreemap. The website where we got our API key from.
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(londonMap);
        
        var londonPlaces = [ // This is what I've explained above. The description and lat + lon was taken from AI overview so that we get the exact information
            { name: 'Big Ben', lat: 51.5007, lon: -0.1246, desc: 'Famous clock tower and symbol of London' },
            { name: 'Tower Bridge', lat: 51.5055, lon: -0.0754, desc: 'Iconic combined bascule and suspension bridge' },
            { name: 'Buckingham Palace', lat: 51.5014, lon: -0.1419, desc: 'Official residence of the British monarch' },
            { name: 'London Eye', lat: 51.5033, lon: -0.1195, desc: 'Giant Ferris wheel on the South Bank' },
            { name: 'Natural History Museum', lat: 51.4967, lon: -0.1764, desc: 'Museum exhibiting natural science collections' },
            { name: 'Tower of London', lat: 51.5081, lon: -0.0754, desc: 'Historic castle and UNESCO World Heritage Site' }
        ];

        // The function helow here makes it so that when you press the marker, the information above shows up
        for (var i = 0; i < londonPlaces.length; i++) {
            var place = londonPlaces[i];
            var marker = L.marker([place.lat, place.lon]).addTo(londonMap);
            marker.bindPopup("<div style='min-width:160px;'><b>" + place.name + "</b><br>" + 
                             "<p style='margin: 5px 0;'>" + place.desc + "</p>" + 
                             "<small style='color: #010807;'>📍 " + place.lat + ", " + place.lon + "</small><br>" +
                            // This was a certainly new addition, found it on this youtube video: https://www.youtube.com/watch?v=rdPNRZBSPdQ
                            // In the video, he made a call (tel:123) function, I changed it to google maps
                             "<a href='https://www.google.com/maps?q=" + place.lat + "," + place.lon + "' target='_blank' style='display: inline-block; margin-top: 8px; color: #e74c3c; text-decoration: none; font-weight: bold;'>🌍 Directions</a></div>"
                            );
        }
    }
    
    // Same as the above, this is the first function but with the element changed to nyc-map so that javascript can ping the markers onto leaflet
    if (document.getElementById('nyc-map')) {
        var nycMap = L.map('nyc-map').setView([40.7128, -74.0060], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(nycMap);
        
        var nycPlaces = [ // This is what I've explained above. The description and lat + lon was taken from AI overview so that we get the exact information
            { name: 'Statue of Liberty', lat: 40.6892, lon: -74.0445, desc: 'Iconic symbol of freedom and democracy' },
            { name: 'Central Park', lat: 40.7812, lon: -73.9665, desc: 'Urban park in Manhattan' },
            { name: 'Empire State Building', lat: 40.7484, lon: -73.9857, desc: 'Famous 102-story skyscraper' },
            { name: 'The High Line', lat: 40.7479, lon: -74.0067, desc: 'Elevated linear park built on a historic freight rail line' },
            { name: 'Madison Square Garden', lat: 40.7505, lon: -73.9936, desc: 'Famous sports and entertainment venue' },
            { name: 'The Metropolitan Museum of Art', lat: 40.7794, lon: -73.9626, desc: 'Largest art museum in the US' }
        ];
        
        // Same as the other function, makes it so that when you press the marker, the information below from above show up
        for (var j = 0; j < nycPlaces.length; j++) {
            var place = nycPlaces[j];
            var marker = L.marker([place.lat, place.lon]).addTo(nycMap);
            // This was a certainly new addition, found it on this youtube video: https://www.youtube.com/watch?v=rdPNRZBSPdQ
            // In the video, he made a call (tel:123) function, I changed it to google maps
            marker.bindPopup("<div style='min-width:160px;'><b>" + place.name + "</b><br>" + 
                             "<p style='margin: 5px 0;'>" + place.desc + "</p>" + 
                             "<small style='color: #010807;'>📍 " + place.lat + ", " + place.lon + "</small><br>" +
                             "<a href='https://www.google.com/maps?q=" + place.lat + "," + place.lon + "' target='_blank' style='display: inline-block; margin-top: 8px; color: #e74c3c; text-decoration: none; font-weight: bold;'>🌎 Directions</a></div>");
        }
    }
    
    // This creates the same function as the 2 shown above, but instead of showing both leaflet maps, it makes it for london.php and nyc.php as a single map
    if (document.getElementById('city-map')) {
        var mapEl = document.getElementById('city-map');
        var lat = parseFloat(mapEl.dataset.lat);
        var lon = parseFloat(mapEl.dataset.lon);
        var city = mapEl.dataset.city;
        
        var map = L.map('city-map').setView([lat, lon], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        
        // Creates the places for the single websites again. I tried tried to take the information that I've already input above, but I kept braking the code
        // As a fix, I decided to create this as it is just me copying the information and pasting them.
        var places;
        if (city === 'london') {
            places = [
                { name: 'Big Ben', lat: 51.5007, lon: -0.1246, desc: 'Famous clock tower and symbol of London' },
                { name: 'Tower Bridge', lat: 51.5055, lon: -0.0754, desc: 'Iconic combined bascule and suspension bridge' },
                { name: 'Buckingham Palace', lat: 51.5014, lon: -0.1419, desc: 'Official residence of the British monarch' },
                { name: 'London Eye', lat: 51.5033, lon: -0.1195, desc: 'Giant Ferris wheel on the South Bank' },
                { name: 'Natural History Museum', lat: 51.4967, lon: -0.1764, desc: 'Museum exhibiting natural science collections' },
                { name: 'Tower of London', lat: 51.5081, lon: -0.0754, desc: 'Historic castle and UNESCO World Heritage Site' }
            ];
        } else { // This makes it so that it uses the New York City places, with their description and lat + lon.
            places = [
                { name: 'Statue of Liberty', lat: 40.6892, lon: -74.0445, desc: 'Iconic symbol of freedom and democracy' },
                { name: 'Central Park', lat: 40.7812, lon: -73.9665, desc: 'Urban park in Manhattan' },
                { name: 'Empire State Building', lat: 40.7484, lon: -73.9857, desc: 'Famous 102-story skyscraper' },
                { name: 'The High Line', lat: 40.7479, lon: -74.0067, desc: 'Elevated linear park built on a historic freight rail line' },
                { name: 'Madison Square Garden', lat: 40.7505, lon: -73.9936, desc: 'Famous sports and entertainment venue' },
                { name: 'The Metropolitan Museum of Art', lat: 40.7794, lon: -73.9626, desc: 'Largest art museum in the US' }
            ];
        }
        
        // This makes it so that when you press the marker from either website, the correct information appears.
        for (var k = 0; k < places.length; k++) {
            var place = places[k];
            var marker = L.marker([place.lat, place.lon]).addTo(map);
            // This was a certainly new addition, found it on this youtube video: https://www.youtube.com/watch?v=rdPNRZBSPdQ
            // In the video, he made a call (tel:123) function, I changed it to google maps
            // This one also uses a different emoji for the "Directions" as I cannot use 2
            marker.bindPopup("<div style='min-width:160px;'><b>" + place.name + "</b><br>" + 
                             "<p style='margin: 5px 0;'>" + place.desc + "</p>" + 
                             "<small style='color: #010807;'>📍 " + place.lat + ", " + place.lon + "</small><br>" +
                             "<a href='https://www.google.com/maps?q=" + place.lat + "," + place.lon + "' target='_blank' style='display: inline-block; margin-top: 8px; color: #e74c3c; text-decoration: none; font-weight: bold;'>➡️ Directions</a></div>");
        }
    }
}

// This function makes it so that the Weather API key is being called.
function loadWeather() {
    if (document.getElementById('weather-london') && document.getElementById('weather-nyc')) {
        // Below the function is being fetched, with the correct city information.
        fetch('api/weather.php?city=london')
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.temp) {
                    // This creates the basic view. Shows humidity, wind and degrees. I've decided to use celcius rather than farenheit.
                    var container = document.getElementById('weather-london');
                    var html = '<div class="weather-card">';
                    html += '<div class="weather-temp">' + data.temp + '</div>';
                    html += '<div class="weather-condition">' + data.conditions + '</div>';
                    html += '<div class="weather-details">';
                    html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                    html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                    html += '</div>';
                    html += '</div>';
                    container.innerHTML = html;
                }
            });
        
        // Below the function is being fetched, with the correct city information.
        fetch('api/weather.php?city=nyc')
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.temp) {
                    // Same as above, it shows the basic view. Although it is New York information here, I still decided to use celcius
                    var container = document.getElementById('weather-nyc');
                    var html = '<div class="weather-card">';
                    html += '<div class="weather-temp">' + data.temp + '</div>';
                    html += '<div class="weather-condition">' + data.conditions + '</div>';
                    html += '<div class="weather-details">';
                    html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                    html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                    html += '</div>';
                    html += '</div>';
                    container.innerHTML = html;
                }
            });
        // If function is correct, it gets returned so that it can be promped
        return;
    }
    // This, as explained above, dispalys the weather, but this time for the individual websites.
    var weatherDisplay = document.getElementById('weather-display');
    if (!weatherDisplay) return;
    
    // Here it fetches and displays information for the london.php
    if (window.location.pathname.includes('london.php')) {
        fetch('api/weather.php?city=london')
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.temp) {
                    var html = '<div class="weather-card">';
                    html += '<div class="weather-temp">' + data.temp + '</div>';
                    html += '<div class="weather-condition">' + data.conditions + '</div>';
                    html += '<div class="weather-details">';
                    html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                    html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                    html += '</div>';
                    html += '</div>';
                    weatherDisplay.innerHTML = html;
                }
            });
    // Here it fetches and displays information for the nyc.php
    } else if (window.location.pathname.includes('nyc.php')) {
        fetch('api/weather.php?city=nyc')
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.temp) {
                    var html = '<div class="weather-card">';
                    html += '<div class="weather-temp">' + data.temp + '</div>';
                    html += '<div class="weather-condition">' + data.conditions + '</div>';
                    html += '<div class="weather-details">';
                    html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                    html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                    html += '</div>';
                    html += '</div>';
                    weatherDisplay.innerHTML = html;
                }
            });
    }
}

// This function was created for london.php and nyc.php. This function doesn't exist on index.php
// It makes it so that you have to press on the place to view the picture, description, and coordinates (lat + lon)
function toggleDetails(card) {
    var details = card.querySelector('.place-details');
    if (details.style.display === 'none' || details.style.display === '') {
        details.style.display = 'block';
    } else {
        details.style.display = 'none';
    }
}

// This was made and for flickr, from: https://www.youtube.com/watch?v=AF5gs8qrnY4 & https://www.youtube.com/watch?v=749ta0nvj8s
// Both tutorials helped differently, there was also some stuff taken from reddit. Like some of the parts of the container below
function loadFlickrPhotos(placeName, containerId) {
    var container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    // Uses any file that has .png at the end of it and the correct name
    var filename = placeName.toLowerCase().replace(/ /g, '-') + '.png';
    // Looks for the files (images) inside the api/images/ folders.
    var imagePath = 'api/images/' + filename;
    // Loads the images
    var html = '<div class="flickr-grid">';
    html += '<div class="place-image-container">';
    html += '<h4>📸 Photo</h4>';
    html += '<div class="place-main-image">';
    html += '<img src="' + imagePath + '" alt="' + placeName + '">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    container.innerHTML = html;
}

// This function makes it so that the page you're currently on gets highlights
function highlightActiveNav() {
    var currentPage = window.location.pathname.split('/').pop();
    // This returns a list of all <a> tags iunside the nav-menu function inside html and css
    var navLinks = document.querySelectorAll('.nav-menu a');
    
    for (var i = 0; i < navLinks.length; i++) {
        // Gather the current link for the iteration of the loop
        var link = navLinks[i];
        // Gather the attributes for the links of the three main websites
        var href = link.getAttribute('href');
        
        // Check if the link matches the page you're on, by checking the name of page. 
        if (href === currentPage || (currentPage === '' && href === 'index.php')) {
            // It creates a border radius of 4px, 8px by 16px and creates the colour around the border red.
            link.style.background = '#D52B1E';
            link.style.borderRadius = '4px';
            link.style.padding = '8px 16px';
        }
    }
}

// This calls all the functions and starts them. All these function must be started as they aren't solo function.
document.addEventListener('DOMContentLoaded', function() {
    initMaps();
    loadWeather();
    highlightActiveNav();
});

// This is the only solo function that is also being called in both london.php and nyc.php.
// It doesn't need to be called above because this isn't the only part of the code, some also are in the two pages mentioned above, that's how it's being called.
// Done this because it refused to work any other way.
function loadWeatherForCity(cityName, containerId) {
    var container = document.getElementById(containerId);
    if (!container) return;
    var city = (cityName === 'London') ? 'london' : 'nyc';
    fetch('api/weather.php?city=' + city)
        .then(function(response) { return response.json(); })
        .then(function(data) {
            // Creates the table as for the other weather.php function. It is the same table, and it works the same as well.
            if (data.temp) {
                var html = '<div class="weather-card">';
                html += '<div class="weather-temp">' + data.temp + '</div>';
                html += '<div class="weather-condition">' + data.conditions + '</div>';
                html += '<div class="weather-details">';
                html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                html += '</div>';
                html += '</div>';
                container.innerHTML = html;
            } else {
                // Differently rather than the display on index.php, this 2 websites have caused me errors when trying to call the API
                // So, incase that happens again, I've added this to know it doesn't work.
                container.innerHTML = '<div class="weather-card">Weather data unavailable</div>';
            }
        })
        .catch(function() {
            // And to make sure the function is being called, I've done it twice. Only one of these show, and by the name I can tell which failed and why.
            container.innerHTML = '<div class="weather-card">Weather data is unavailable.</div>';
        });
}