<?php

namespace App\Controllers;

use PDO;
use App\App\Database;
use App\App\WorldCityRepository;


class EditCityController
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
            header('Location: /');
            die();
        }

        if (!empty($_POST)) {
            $cityData = [
                'city' => (string) ($_POST['city'] ?? ''),
                'cityAscii' => (string) ($_POST['cityAscii'] ?? ''),
                'country' => (string) ($_POST['country'] ?? ''),
                'iso2' => (string) ($_POST['iso2'] ?? ''),
                'population' => (int) ($_POST['population'] ?? 0)
            ];

            if ($this->validateCityData($cityData)) {
                $this->worldCityRepository->update($id, $cityData);
                header('Location: /');
                die();
            }
        }

        $this->render('edit.view', ['city' => $city]);
    }

    private function validateCityData($data)
    {
        return !empty($data['city']) && !empty($data['cityAscii']) &&
            !empty($data['country']) && !empty($data['iso2']) &&
            !empty($data['population']);
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
