<?php
namespace App\Controllers;

require './../../vendor/autoload.php';

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Entity\User;



$requestMethod = $_SERVER["REQUEST_METHOD"];

$data = json_decode(file_get_contents("php://input"));

$token = str_replace('Bearer ', '', getallheaders()['Authorization']);

echo $data;

$usersmanager = new UserManager((new PDOFactory())->getMysqlConnection());
$newUser = new User( 
    $data->username, 
    $data->pass,
    $token
);

if(strtoupper($requestMethod) == "POST")

{

    $usersmanager->createUser($newUser);

}    

else {

    http_response_code(405);
    echo "Method Not Allowed";
    die();

}




function RandToken($longueur)
{
 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $longueurMax = strlen($caracteres);
 $chaineAleatoire = '';
 for ($i = 0; $i < $longueur; $i++)
 {
 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
 }
 return $chaineAleatoire;
}