<?php
namespace App;

use PDO;
use App\Database;
use App\Pagination;
use App\WorldCityRepository;

class App
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
        $pagination = new Pagination($_GET['page'] ?? 1);

        $count = $this->worldCityRepository->count();
        $entries = $this->worldCityRepository->paginate($pagination->getPage(), $pagination->getPerPage());

        $this->render('index.view', [
            'entries' => $entries,
            'pagination' => [
                'count' => $count,
                'perPage' => $pagination->getPerPage(),
                'page' => $pagination->getPage()
            ]
        ]);
    }

    private function render($view, $data)
    {
        
        extract($data);

        ob_start();

        require __DIR__ . '/../views/pages/' . $view . '.php';
        $contents = ob_get_clean();

        require __DIR__ . '/../views/layouts/main.view.php';
    }
}

