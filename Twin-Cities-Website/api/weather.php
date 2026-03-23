<?php
// Uses config for the the API
include_once '../config.php';

header('Content-Type: application/json');

function getWeatherForCity($city, $countryCode) {
    // Uses the API from config.php, to be specific, the one named WEATHER_API_KEY.
    $url = WEATHER_API_URL . "?q=" . urlencode($city) . "," . $countryCode . "&units=metric&appid=" . WEATHER_API_KEY;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Makes sure the API is called and works
    if ($response !== false && $httpCode == 200) {
        $data = json_decode($response, true);
        if (isset($data['main'])) {
            return [
                'temp' => round($data['main']['temp']) . '°C',
                'conditions' => ucfirst($data['weather'][0]['description']),
                'humidity' => $data['main']['humidity'] . '%',
                'wind' => round($data['wind']['speed'], 1) . ' m/s',
                'icon' => getWeatherIcon($data['weather'][0]['icon'])
            ];
        }
    }
    
    // If the API fails, it loads this basic information.
    if (strtolower($city) == 'london') {
        return [ // For London, false information - this is not accurate.
            'temp' => '14°C',
            'conditions' => 'Cloudy',
            'humidity' => '72%',
            'wind' => '3.1 m/s',
            'icon' => '☁️'
        ];
    } else {
        return [ // For New York, false information - this is not accurate.
            'temp' => '17°C',
            'conditions' => 'Sunny',
            'humidity' => '60%',
            'wind' => '2.5 m/s',
            'icon' => '☀️'
        ];
    }
}

// Uses this icons to represent the weather. The icons are shown here so that they do not have to be shown in index / london / nyc.php.
// This was a referenced and it was gathered from: https://openweathermap.org/weather-conditions , all the icons and information are from the website.
function getWeatherIcon($iconCode) {
    $icons = [
        '01d' => '☀️', '01n' => '🌙',
        '02d' => '⛅', '02n' => '☁️',
        '03d' => '☁️', '03n' => '☁️',
        '04d' => '☁️', '04n' => '☁️',
        '09d' => '🌧️', '09n' => '🌧️',
        '10d' => '🌦️', '10n' => '🌧️',
        '11d' => '⛈️', '11n' => '⛈️',
        '13d' => '❄️', '13n' => '❄️',
        '50d' => '🌫️', '50n' => '🌫️'
    ];
    return $icons[$iconCode] ?? '☀️';
}

// Check if there is a city parameter in the URL. If it exists, set $city to that value. If not, it becomes an empty string.
$city = isset($_GET['city']) ? $_GET['city'] : '';

// This checks what type of weather the user requested (by vising the websites)
if ($city == 'london') { // This calls the london weather, as requested
    echo json_encode(getWeatherForCity('London', 'uk'));
} elseif ($city == 'nyc') { // This calls the nyc weather, as requested
    echo json_encode(getWeatherForCity('New York', 'us'));
} else { // This function was made for index.php so that both functions are called at the same time
    echo json_encode([
        'london' => getWeatherForCity('London', 'uk'),
        'nyc' => getWeatherForCity('New York', 'us')
    ]);
}
?>