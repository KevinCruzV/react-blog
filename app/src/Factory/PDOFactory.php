<?php 

namespace App\Factory;

use Exception;

const DB_HOST = 'db';
const DB_NAME = 'react_blog';
const DB_USER = 'root';
const DB_PWD = 'password';

class PDOFactory
{
    /**
     * @var string
     */
    protected string $login;
    /**
     * @var string
     */
    protected string $db_name;
    /**
     * @var string
     */
    protected string $password;
    /**
     * @var string
     */
    protected string  $db_host;



    public function __construct()
    {
        $this->db_host = DB_HOST;
        $this->login = DB_USER;
        $this->password = DB_PWD;
        $this->db_name = DB_NAME;

    }

    public function getMysqlConnection()
    {
        try {
            $bdd = new \PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';
            ', $this->login, $this->password);

            $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            $bdd->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);


        } catch (Exception $e) {
            $msg = $e->getMessage();
            die($msg);
        }

        return $bdd;
    }
}