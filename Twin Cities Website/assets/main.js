let londonMap, nycMap;
let markers = [];

function initializeMaps() {
    if (document.getElementById('london-map')) {
        londonMap = L.map('london-map').setView([51.5074, -0.1278], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(londonMap);
        loadPlacesForMap(1, londonMap);
    }
    
    if (document.getElementById('nyc-map')) {
        nycMap = L.map('nyc-map').setView([40.7128, -74.0060], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(nycMap);
        
        loadPlacesForMap(2, nycMap);
    }
}

function initCityMap() {
    const mapElement = document.getElementById('city-map');
    if (!mapElement) return;
    
    const lat = parseFloat(mapElement.dataset.lat);
    const lon = parseFloat(mapElement.dataset.lon);
    const cityName = mapElement.dataset.name;
    
    const map = L.map('city-map').setView([lat, lon], 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    L.marker([lat, lon])
        .bindPopup(`<b>${cityName}</b><br>City Center`)
        .addTo(map);
    
    const cityId = window.location.pathname.includes('cities.php') 
        ? new URLSearchParams(window.location.search).get('id') 
        : (cityName === 'London' ? 1 : 2);
    
    if (cityId) {
        loadPlacesForMap(cityId, map);
    }
}

function loadPlacesForMap(cityId, map) {
    
    let places = [];
    
    if (cityId == 1) {
        places = [
            // All these locations are taken randomly from other forums and websites. Their lat and lon come with them as well.
            { name: 'London Eye', lat: 51.503324, lon: -0.119522, desc: 'Giant Ferris wheel on the South Bank' },
            { name: 'Big Ben', lat: 51.500729, lon: -0.124625, desc: 'Great Clock of Westminster' },
            { name: 'Tower of London', lat: 51.508112, lon: -0.076067, desc: 'Historic castle and former prison' },
            { name: 'Buckingham Palace', lat: 51.501476, lon: -0.141890, desc: 'Official residence of the monarch' },
            { name: 'Wembley Stadium', lat: 51.556021, lon: -0.279549, desc: 'National stadium with 90,000 capacity' },
            { name: 'Natural History Museum', lat: 51.496510, lon: -0.176707, desc: 'Museum with dinosaur skeletons' }
        ];
    } else {
        places = [
            // All these locations are taken randomly from other forums and websites. Their lat and lon come with them as well.
            { name: 'Statue of Liberty', lat: 40.689247, lon: -74.044502, desc: 'Iconic national monument' },
            { name: 'Empire State Building', lat: 40.748817, lon: -73.985656, desc: 'Famous skyscraper with observatory' },
            { name: 'Central Park', lat: 40.782865, lon: -73.966545, desc: 'Urban park with lakes and trails' },
            { name: 'Madison Square Garden', lat: 40.750500, lon: -73.993397, desc: 'Famous sports and entertainment venue' },
            { name: 'Metropolitan Museum of Art', lat: 40.779479, lon: -73.963203, desc: 'Massive art museum with 2 million works' },
            { name: 'MetLife Stadium', lat: 40.813507, lon: -74.074459, desc: 'NFL stadium seating 82,500' }
        ];
    }
    
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];
    
    places.forEach(place => {
        const marker = L.marker([place.lat, place.lon])
            .bindPopup(`
                <div class="place-popup">
                    <h4>${place.name}</h4>
                    <p>${place.desc}</p>
                    <a href="place.php?name=${encodeURIComponent(place.name)}" class="place-popup-btn">View Details</a>
                </div>
            `);
        
        marker.on('mouseover', function() {
            this.openPopup();
        });
        
        marker.addTo(map);
        markers.push(marker);
    });
}

function loadWeather() {
    
    const weatherContainers = document.querySelectorAll('.weather-container');
    if (!weatherContainers.length) return;
    
    const londonWeather = {
        temp: 15,
        condition: 'Partly Cloudy',
        humidity: 72,
        wind: 12,
        icon: 'fa-cloud-sun'
    };
    
    const nycWeather = {
        temp: 18,
        condition: 'Sunny',
        humidity: 65,
        wind: 8,
        icon: 'fa-sun'
    };
    
    weatherContainers.forEach(container => {
        container.innerHTML = '';
    });
    
    if (document.getElementById('weather-london')) {
        document.getElementById('weather-london').appendChild(createWeatherCard('London', londonWeather));
    }
    
    if (document.getElementById('weather-nyc')) {
        document.getElementById('weather-nyc').appendChild(createWeatherCard('New York', nycWeather));
    }
}

function createWeatherCard(cityName, weather) {
    const card = document.createElement('div');
    card.className = 'weather-card';
    
    card.innerHTML = `
        <div class="weather-header">
            <h3>${cityName}</h3>
            <i class="fas ${weather.icon} fa-2x"></i>
        </div>
        <div class="weather-temp">${weather.temp}°C</div>
        <div class="weather-condition">${weather.condition}</div>
        <div class="weather-details">
            <div><i class="fas fa-tint"></i> Humidity: ${weather.humidity}%</div>
            <div><i class="fas fa-wind"></i> Wind: ${weather.wind} km/h</div>
        </div>
    `;
    
    return card;
}

function loadFeaturedPlaces() {
    const container = document.getElementById('featured-places');
    if (!container) return;
    
    const places = [
        { name: 'London Eye', city: 'London', desc: 'Giant Ferris wheel', img: 'https://via.placeholder.com/300x200?text=London+Eye' },
        { name: 'Big Ben', city: 'London', desc: 'Great Clock', img: 'https://via.placeholder.com/300x200?text=Big+Ben' },
        { name: 'Statue of Liberty', city: 'New York', desc: 'Iconic monument', img: 'https://via.placeholder.com/300x200?text=Statue+of+Liberty' },
        { name: 'Empire State Building', city: 'New York', desc: 'Famous skyscraper', img: 'https://via.placeholder.com/300x200?text=Empire+State' }
    ];
    
    container.innerHTML = '';
    
    places.forEach(place => {
        const card = document.createElement('div');
        card.className = 'place-card';
        card.innerHTML = `
            <div class="place-image">
                <img src="${place.img}" alt="${place.name}">
            </div>
            <div class="place-details">
                <h3>${place.name}</h3>
                <p class="place-address"><i class="fas fa-map-marker-alt"></i> ${place.city}</p>
                <p class="place-description">${place.desc}</p>
                <a href="place.php?name=${encodeURIComponent(place.name)}" class="btn btn-small">View Details</a>
            </div>
        `;
        container.appendChild(card);
    });
}

function setupCitySelector() {
    const buttons = document.querySelectorAll('.city-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const cityId = this.dataset.cityId;
            window.location.href = `cities.php?id=${cityId}`;
        });
    });
}


document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('london-map') || document.getElementById('nyc-map')) {
        initializeMaps();
    }
    loadWeather();
    loadFeaturedPlaces();
    setupCitySelector();
    
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation.split('/').pop()) {
            link.classList.add('active');
        }
    });
});