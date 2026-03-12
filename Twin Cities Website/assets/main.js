function initMaps() {
    if (document.getElementById('london-map')) {
        var londonMap = L.map('london-map').setView([51.5074, -0.1278], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(londonMap);
        
        // Add markers based on London city page, making it simpler to find that place
        var londonPlaces = [
            { name: 'Big Ben', lat: 51.5007, lon: -0.1246 },
            { name: 'Tower Bridge', lat: 51.5055, lon: -0.0754 },
            { name: 'Buckingham Palace', lat: 51.5014, lon: -0.1419 },
            { name: 'London Eye', lat: 51.5033, lon: -0.1195 },
            { name: 'Natural History Museum', lat: 51.4967, lon: -0.1764 },
            { name: 'Tower of London', lat: 51.5081, lon: -0.0754 }
        ];
        
        for (var i = 0; i < londonPlaces.length; i++) {
            var place = londonPlaces[i];
            L.marker([place.lat, place.lon])
                .bindPopup(place.name)
                .addTo(londonMap);
        }
    }
    
    if (document.getElementById('nyc-map')) {
        var nycMap = L.map('nyc-map').setView([40.7128, -74.0060], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(nycMap);
        
        // Add markers based on NYC city page, making it simpler to find that place
        var nycPlaces = [
            { name: 'Statue of Liberty', lat: 40.6892, lon: -74.0445 },
            { name: 'Central Park', lat: 40.7812, lon: -73.9665 },
            { name: 'Empire State Building', lat: 40.7484, lon: -73.9857 },
            { name: 'The High Line', lat: 40.7479, lon: -74.0067 },
            { name: 'Madison Square Garden', lat: 40.7505, lon: -73.9936 },
            { name: 'The Metropolitan Museum of Art', lat: 40.7794, lon: -73.9626 }
        ];
        
        for (var j = 0; j < nycPlaces.length; j++) {
            var place = nycPlaces[j];
            L.marker([place.lat, place.lon])
                .bindPopup(place.name)
                .addTo(nycMap);
        }
    }
    
    // Single city page map (london.php or nyc.php)
    if (document.getElementById('city-map')) {
        var mapEl = document.getElementById('city-map');
        var lat = parseFloat(mapEl.dataset.lat);
        var lon = parseFloat(mapEl.dataset.lon);
        var city = mapEl.dataset.city;
        
        var map = L.map('city-map').setView([lat, lon], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        
        if (city === 'london') {
            var places = [
                { name: 'Big Ben', lat: 51.5007, lon: -0.1246 },
                { name: 'Tower Bridge', lat: 51.5055, lon: -0.0754 },
                { name: 'Buckingham Palace', lat: 51.5014, lon: -0.1419 },
                { name: 'London Eye', lat: 51.5033, lon: -0.1195 },
                { name: 'Natural History Museum', lat: 51.4967, lon: -0.1764 },
                { name: 'Tower of London', lat: 51.5081, lon: -0.0754 }
            ];
        } else {
            var places = [
                { name: 'Statue of Liberty', lat: 40.6892, lon: -74.0445 },
                { name: 'Central Park', lat: 40.7812, lon: -73.9665 },
                { name: 'Empire State Building', lat: 40.7484, lon: -73.9857 },
                { name: 'The High Line', lat: 40.7479, lon: -74.0067 },
                { name: 'Madison Square Garden', lat: 40.7505, lon: -73.9936 },
                { name: 'The Metropolitan Museum of Art', lat: 40.7794, lon: -73.9626 }
            ];
        }
        
        for (var k = 0; k < places.length; k++) {
            var place = places[k];
            L.marker([place.lat, place.lon])
                .bindPopup(place.name)
                .addTo(map);
        }
    }
}

function loadWeather() {
    // This information goes onto index.php -> Do not change
    if (document.getElementById('weather-london') && document.getElementById('weather-nyc')) {
        // London weather
        var londonWeather = document.getElementById('weather-london');
        londonWeather.innerHTML = '<div class="weather-card"><div class="weather-temp">15°C</div><div class="weather-condition">Partly cloudy</div><div class="weather-details"><div>💧 72%</div><div>🌬️ 3.1 m/s</div></div></div>';
        
        // NYC weather
        var nycWeather = document.getElementById('weather-nyc');
        nycWeather.innerHTML = '<div class="weather-card"><div class="weather-temp">18°C</div><div class="weather-condition">Sunny</div><div class="weather-details"><div>💧 60%</div><div>🌬️ 2.5 m/s</div></div></div>';
        
        return;
    }
    
    // This function makes it so that it changes the display for individual pages (london.php & nyc.php)
    var weatherDisplay = document.getElementById('weather-display');
    if (!weatherDisplay) return;
    
    // This function checks what page we are on
    if (window.location.pathname.includes('london.php')) {
        weatherDisplay.innerHTML = '<div class="weather-card"><div class="weather-temp">15°C</div><div class="weather-condition">Partly cloudy</div><div class="weather-details"><div>💧 72%</div><div>🌬️ 3.1 m/s</div></div></div>';
    } else if (window.location.pathname.includes('nyc.php')) {
        weatherDisplay.innerHTML = '<div class="weather-card"><div class="weather-temp">18°C</div><div class="weather-condition">Sunny</div><div class="weather-details"><div>💧 60%</div><div>🌬️ 2.5 m/s</div></div></div>';
    }
}

// Toggle the place once it's clicked
function toggleDetails(card) {
    var details = card.querySelector('.place-details');
    if (details.style.display === 'none' || details.style.display === '') {
        details.style.display = 'block';
    } else {
        details.style.display = 'none';
    }
}

// Load and start Flickr, make sure sample photos are available
function loadFlickrPhotos(placeName, containerId) {
    var container = document.getElementById(containerId);
    if (!container) return;
    
    // Clear container
    container.innerHTML = '';
    
    // Create image filename from place name
    var filename = placeName.toLowerCase().replace(/ /g, '-') + '.png';
    
    var html = '<div class="flickr-grid">';
    
    // Show the same local image 4 times (or however many you want)
    for (var i = 0; i < 4; i++) {
        html += '<div class="flickr-thumb">';
        html += '<img src="assets/images/' + filename + '" alt="' + placeName + '">';
        html += '</div>';
    }
    
    html += '</div>';
    container.innerHTML = html;
}

function highlightActiveNav() {
    var currentPage = window.location.pathname.split('/').pop();
    var navLinks = document.querySelectorAll('.nav-menu a');
    
    for (var i = 0; i < navLinks.length; i++) {
        var link = navLinks[i];
        var href = link.getAttribute('href');
        
        if (href === currentPage) {
            link.style.background = '#D52B1E';
            link.style.borderRadius = '4px';
            link.style.padding = '0.5rem 1rem';
        }
        
        // Special case for index page
        if (currentPage === '' || currentPage === 'index.php' && href === 'index.php') {
            link.style.background = '#D52B1E';
            link.style.borderRadius = '4px';
            link.style.padding = '0.5rem 1rem';
        }
    }
}

// Start everything once the index.html starts
document.addEventListener('DOMContentLoaded', function() {
    initMaps();
    loadWeather();
    highlightActiveNav();
});