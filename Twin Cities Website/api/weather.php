<?php
require_once '../config/config.php';
header('Content-Type: application/json');

function getWeather($city, $countryCode) {
    // Metric is hardcoded - always uses °C for the UK!
    $url = WEATHER_API_URL . "?q=" . urlencode($city) . "," . $countryCode . "&units=metric&appid=" . WEATHER_API_KEY;
    
    $response = @file_get_contents($url);
    
    if ($response === false) {
        return ['error' => true, 'message' => 'Could not fetch weather data'];
    }
    
    $data = json_decode($response, true);
    
    if (isset($data['main'])) {
        return [
            'city' => $data['name'],
            'country' => $data['sys']['country'],
            'temp' => round($data['main']['temp']) . '°C',
            'feels_like' => round($data['main']['feels_like']) . '°C',
            'humidity' => $data['main']['humidity'] . '%',
            'wind_speed' => round($data['wind']['speed'], 1) . ' m/s',
            'conditions' => $data['weather'][0]['description']
        ];
    }
    
    return ['error' => true, 'message' => 'Invalid response from weather service'];
}

$weather = [
    'london' => getWeather('London', 'uk'),
    'newyork' => getWeather('New York', 'us')
];

echo json_encode($weather, JSON_PRETTY_PRINT);
?>