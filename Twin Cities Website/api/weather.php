<?php
include_once '../config.php';
header('Content-Type: application/json');

function getForecast($city, $countryCode) {
    // Try to call the API - if it works, use real data
    $url = "https://api.openweathermap.org/data/2.5/forecast?q=" . urlencode($city) . "," . $countryCode . "&units=metric&appid=" . WEATHER_API_KEY;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // If API call works (HTTP 200), use real data
    if ($response !== false && $httpCode == 200) {
        $data = json_decode($response, true);
        
        if (isset($data['list'])) {
            // Get one forecast per day (midday)
            $forecast = [];
            $dates = [];
            
            foreach ($data['list'] as $item) {
                $date = substr($item['dt_txt'], 0, 10);
                $time = substr($item['dt_txt'], 11, 5);
                
                if (!in_array($date, $dates) && $time >= '11:00' && $time <= '14:00') {
                    $dates[] = $date;
                    
                    $timestamp = strtotime($item['dt_txt']);
                    $dayName = 'Today';
                    if (date('Y-m-d') == $date) {
                        $dayName = 'Today';
                    } elseif (date('Y-m-d', strtotime('+1 day')) == $date) {
                        $dayName = 'Tomorrow';
                    } else {
                        $dayName = date('l', $timestamp);
                    }
                    
                    $forecast[] = [
                        'day' => $dayName,
                        'temp' => round($item['main']['temp']) . '°C',
                        'conditions' => ucfirst($item['weather'][0]['description']),
                        'icon' => getWeatherIcon($item['weather'][0]['icon']),
                        'humidity' => $item['main']['humidity'] . '%',
                        'wind' => round($item['wind']['speed'], 1) . ' m/s'
                    ];
                    
                    if (count($forecast) >= 3) break;
                }
            }
            
            return [
                'city' => $data['city']['name'],
                'country' => $data['city']['country'],
                'forecast' => $forecast,
                'source' => 'api'
            ];
        }
    }
    
    // If API call fails, use sample data (no key checking needed)
    $cityName = ($city == 'London' || $city == 'london') ? 'London' : 'New York';
    $country = $cityName == 'London' ? 'UK' : 'US';
    
    if ($cityName == 'London') {
        return [
            'city' => 'London',
            'country' => 'UK',
            'forecast' => [
                ['day' => 'Today', 'temp' => '15°C', 'conditions' => 'Partly cloudy', 'icon' => '⛅', 'humidity' => '72%', 'wind' => '3.1 m/s'],
                ['day' => 'Tomorrow', 'temp' => '14°C', 'conditions' => 'Light rain', 'icon' => '🌧️', 'humidity' => '78%', 'wind' => '4.2 m/s'],
                ['day' => 'Wednesday', 'temp' => '16°C', 'conditions' => 'Sunny', 'icon' => '☀️', 'humidity' => '65%', 'wind' => '2.8 m/s']
            ],
            'source' => 'sample'
        ];
    } else {
        return [
            'city' => 'New York',
            'country' => 'US',
            'forecast' => [
                ['day' => 'Today', 'temp' => '18°C', 'conditions' => 'Sunny', 'icon' => '☀️', 'humidity' => '60%', 'wind' => '2.5 m/s'],
                ['day' => 'Tomorrow', 'temp' => '17°C', 'conditions' => 'Partly cloudy', 'icon' => '⛅', 'humidity' => '65%', 'wind' => '3.0 m/s'],
                ['day' => 'Wednesday', 'temp' => '19°C', 'conditions' => 'Sunny', 'icon' => '☀️', 'humidity' => '58%', 'wind' => '2.2 m/s']
            ],
            'source' => 'sample'
        ];
    }
}

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

$city = isset($_GET['city']) ? $_GET['city'] : '';

if ($city == 'london') {
    echo json_encode(getForecast('London', 'uk'));
} elseif ($city == 'nyc') {
    echo json_encode(getForecast('New York', 'us'));
} else {
    echo json_encode([
        'london' => getForecast('London', 'uk'),
        'nyc' => getForecast('New York', 'us')
    ]);
}
?>