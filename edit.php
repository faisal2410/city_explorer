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
$model = $worldCityRepository->fetchById($id);

if (empty($model)) {
    header('Location: index.php');
    die();
}

if (!empty($_POST)) {
    $city = (string) ($_POST['city'] ?? '');
    $cityAscii = (string) ($_POST['cityAscii'] ?? '');
    $country = (string) ($_POST['country'] ?? '');
    $iso2 = (string) ($_POST['iso2'] ?? '');
    $population = (int) ($_POST['population'] ?? 0);

    if (
        empty($city) ||
        empty($cityAscii) ||
        empty($country) ||
        empty($iso2) ||
        empty($population)
    ) {

        header('Location: index.php');
        die();
    }

    $model = $worldCityRepository->update($id, [
        'city' => $city,
        'cityAscii' => $cityAscii,
        'country' => $country,
        'iso2' => $iso2,
        'population' => $population
    ]);

    header('Location: index.php');
    die();
}


render('edit.view', [
    'city' => $model
]);
