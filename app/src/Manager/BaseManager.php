<?php

namespace App\Manager;

use App\Factory\PDOFactory;


class BaseManager
{

    protected \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;

    }

}