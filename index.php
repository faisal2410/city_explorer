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


$worldCityRepository = new WorldCityRepository($pdo);

$page = (int) ($_GET['page'] ?? 1);
$page = max(1, $page);

$perPage = 15;

$count = $worldCityRepository->count();
$entries = $worldCityRepository->paginate($page, $perPage);

render('index.view', [
    'entries' => $entries,
    'pagination' => [
        'count' => $count,
        'perPage' => $perPage,
        'page' => $page
    ]
]);
