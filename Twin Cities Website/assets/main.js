let markers = [];

function initCityMap() {
    const mapElement = document.getElementById('city-map');
    if (!mapElement) return;
    
    const lat = parseFloat(mapElement.dataset.lat);
    const lon = parseFloat(mapElement.dataset.lon);
    const cityName = mapElement.dataset.city;
    
    const map = L.map('city-map').setView([lat, lon], 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    const cityId = cityName === 'london' ? 1 : 2;
    loadPlacesForMap(cityId, map);
}

function loadPlacesForMap(cityId, map) {
    fetch(`api/places.php?city_id=${cityId}`)
        .then(response => response.json())
        .then(places => {
            // Clear any old marker set
            if (markers.length) {
                markers.forEach(marker => map.removeLayer(marker));
                markers = [];
            }
            
            places.forEach(place => {
                const marker = L.marker([place.Lat, place.Lon])
                    .bindPopup(`
                        <div class="place-popup">
                            <h4>${place.NameofLocation}</h4>
                            <p>${place.Place_Description}</p>
                            <p><small>${place.StreetName}</small></p>
                        </div>
                    `);
                
                marker.on('mouseover', function() {
                    this.openPopup();
                });
                
                marker.addTo(map);
                markers.push(marker);
            });
        });
}

function loadWeather() {
    fetch('api/weather.php')
        .then(response => response.json())
        .then(data => {
            const weatherDisplay = document.getElementById('weather-display');
            if (!weatherDisplay) return;
            
            // Now it might work -> Check page, test
            if (window.location.pathname.includes('london.php') && data.london) {
                updateWeatherDisplay(data.london);
            } else if (window.location.pathname.includes('nyc.php') && data.newyork) {
                updateWeatherDisplay(data.newyork);
            }
        });
}

function updateWeatherDisplay(weather) {
    const container = document.getElementById('weather-display');
    if (!container) return;
    
    container.innerHTML = `
        <div class="weather-card">
            <div class="weather-temp">${weather.temp}</div>
            <div class="weather-condition">${weather.conditions}</div>
            <div class="weather-details">
                <div>Feels like: ${weather.feels_like}</div>
                <div>Humidity: ${weather.humidity}</div>
                <div>Wind: ${weather.wind_speed}</div>
            </div>
        </div>
    `;
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('city-map')) {
        initCityMap();
    }
    loadWeather();
    
    const currentLocation = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation) {
            link.classList.add('active');
        }
    });
});