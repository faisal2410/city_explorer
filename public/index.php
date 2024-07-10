<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\EditCityController;
use App\Controllers\CityController;

// Simple routing logic
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$query = [];
if ($queryString) {
    parse_str($queryString, $query);
}

if ($uri === '/' || $uri === '/index.php') {
    $controller = new HomeController();
    $controller->run();
} elseif ($uri === '/edit.php') {
    $controller = new EditCityController();
    $controller->run();
} elseif ($uri === '/city.php') {
    $id = $query['id'] ?? null;
    if ($id) {
        $controller = new CityController();
        $controller->show($id);
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
} else {
    http_response_code(404);
    echo "404 Not Found";
}





/*


require __DIR__ . '/../vendor/autoload.php';
use App\Controllers\HomeController;




$controller = new HomeController();

$controller->run();

*/ 
