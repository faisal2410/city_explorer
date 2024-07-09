<?php

namespace App\Controllers;

use PDO;
use App\App\Database;
use App\App\WorldCityRepository;


class CityController
{
    private $db;
    private $worldCityRepository;

    public function __construct()
    {
        $this->db = new Database('mysql:host=localhost;dbname=cities;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $this->worldCityRepository = new WorldCityRepository($this->db->getConnection());
    }

    public function run()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $city = $this->worldCityRepository->fetchById($id);

        if (empty($city)) {
            header('Location: index.php');
            die();
        }

        $this->render('city.view', [
            'city' => $city
        ]);
    }

    private function render($view, $data)
    {

        extract($data);

        ob_start();

        require __DIR__ . '/../../views/pages/' . $view . '.php';
        $contents = ob_get_clean();

        require __DIR__ . '/../../views/layouts/main.view.php';
    }
}
