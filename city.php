<?php

use App\WorldCityRepository;


require __DIR__ . '/vendor/autoload.php';


try {
    $pdo = new PDO('mysql:host=localhost;dbname=cities;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    // var_dump($e->getMessage());
    echo 'A problem occured with the database connection...';
    die();
}

$id = (int) ($_GET['id'] ?? 0);

$worldCityRepository = new WorldCityRepository($pdo);
$city = $worldCityRepository->fetchById($id);

if (empty($city)) {
    header('Location: index.php');
    die();
}

render('city.view', [
    'city' => $city
]);
