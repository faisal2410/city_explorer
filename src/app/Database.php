<?php

namespace App\App;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct($dsn, $username, $password, $options = [])
    {
        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            echo 'A problem occurred with the database connection...';
            die();
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
