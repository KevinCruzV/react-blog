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
use App\Manager\PostManager;



$requestMethod = $_SERVER["REQUEST_METHOD"];

$users = new PostManager((new PDOFactory())->getMysqlConnection());


if(strtoupper($requestMethod) == "GET")

{

    $users->getAllPosts();

}    

else {

    http_response_code(405);
    echo "Method Not Allowed";
    die();

}
