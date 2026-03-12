<?php

include_once '../db_connect.php';

header('Content-Type: application/json');

$weatherData = [
    // London Weather Location
    'Big Ben' => [
        'temp' => '15°C',
        'conditions' => 'Partly cloudy',
        'humidity' => '72%',
        'wind' => '3.1 m/s',
        'icon' => '⛅'
    ],
    'Tower Bridge' => [
        'temp' => '14°C',
        'conditions' => 'Light rain',
        'humidity' => '78%',
        'wind' => '4.2 m/s',
        'icon' => '🌧️'
    ],
    'Buckingham Palace' => [
        'temp' => '15°C',
        'conditions' => 'Partly cloudy',
        'humidity' => '71%',
        'wind' => '3.0 m/s',
        'icon' => '⛅'
    ],
    'London Eye' => [
        'temp' => '15°C',
        'conditions' => 'Cloudy',
        'humidity' => '73%',
        'wind' => '3.5 m/s',
        'icon' => '☁️'
    ],
    'Natural History Museum' => [
        'temp' => '14°C',
        'conditions' => 'Light rain',
        'humidity' => '76%',
        'wind' => '3.8 m/s',
        'icon' => '🌧️'
    ],
    'Tower of London' => [
        'temp' => '14°C',
        'conditions' => 'Cloudy',
        'humidity' => '74%',
        'wind' => '3.2 m/s',
        'icon' => '☁️'
    ],
    
    // NYC Weather Location
    'Statue of Liberty' => [
        'temp' => '18°C',
        'conditions' => 'Sunny',
        'humidity' => '60%',
        'wind' => '2.5 m/s',
        'icon' => '☀️'
    ],
    'Central Park' => [
        'temp' => '17°C',
        'conditions' => 'Sunny',
        'humidity' => '62%',
        'wind' => '2.3 m/s',
        'icon' => '☀️'
    ],
    'Empire State Building' => [
        'temp' => '18°C',
        'conditions' => 'Sunny',
        'humidity' => '59%',
        'wind' => '2.8 m/s',
        'icon' => '☀️'
    ],
    'The High Line' => [
        'temp' => '17°C',
        'conditions' => 'Partly cloudy',
        'humidity' => '64%',
        'wind' => '2.6 m/s',
        'icon' => '⛅'
    ],
    'Madison Square Garden' => [
        'temp' => '18°C',
        'conditions' => 'Sunny',
        'humidity' => '61%',
        'wind' => '2.4 m/s',
        'icon' => '☀️'
    ],
    'The Metropolitan Museum of Art' => [
        'temp' => '17°C',
        'conditions' => 'Partly cloudy',
        'humidity' => '63%',
        'wind' => '2.2 m/s',
        'icon' => '⛅'
    ]
];

// Pull all the places from the database
$places = $pdo->query("SELECT p.*, c.Name as city_name FROM place_of_interest p JOIN city c ON p.City_ID = c.City_ID")->fetchAll();

$result = [];
foreach ($places as $place) {
    $name = $place['NameofLocation'];
    $result[] = [
        'place_id' => $place['Place_of_InterestID'],
        'place_name' => $name,
        'city' => $place['city_name'],
        'weather' => $weatherData[$name] ?? [
            'temp' => $place['city_name'] == 'London' ? '15°C' : '18°C',
            'conditions' => $place['city_name'] == 'London' ? 'Cloudy' : 'Sunny',
            'humidity' => '70%',
            'wind' => '3.0 m/s',
            'icon' => $place['city_name'] == 'London' ? '☁️' : '☀️'
        ],
        'coordinates' => [
            'lat' => $place['Lat'],
            'lon' => $place['Lon']
        ]
    ];
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>