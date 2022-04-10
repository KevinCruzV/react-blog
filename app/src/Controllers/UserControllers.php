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



$requestMethod = $_SERVER["REQUEST_METHOD"];

$users = new UserManager((new PDOFactory())->getMysqlConnection());
$data = json_decode(file_get_contents("php://input"));

$token = $users->getTokenByUser($data->username);

if(strtoupper($requestMethod) == "GET")

{


   if(($log['username'] == $data->username) && ($log['pass'] == $data->pass) ){

    $_SESSION["token"] = $token;
    http_response_code(200);

   }

   else{
    http_response_code(405);
    echo "persone";
   }

}    

else {

    http_response_code(500);
    echo "Method Not Allowed";
    

}











function executeAuthor()
{
    $userManager = new UserManager((new PDOFactory())->getMysqlConnection());
    $userManager->getAllUsers();

}





function executeMyaccount()
{
    $userManager = new UserManager((new PDOFactory())->getMysqlConnection());
    $users = $userManager->getAllUsers();

}

    

function executeLogout(): void
{
    session_destroy();
    header("Location: /");
    exit;
}


/**
 * @return void
 */
function executeValidsignup()
{
    $userManager = new UserManager((new PDOFactory())->getMysqlConnection());

    if ($userManager->validateSignUp()):

        $userManager->login();

        header("Location: login");


    else:

        header("Location: signUp"); // Je redirige vers la page de login sans authorisation

    endif;

    exit;
}

function executeDelete()
{
    $userManager = new UserManager((new PDOFactory())->getMysqlConnection());

    if ($userManager->Delete()):

        header("Location: /author");


    else:

        header("Location: /error404");

    endif;

    exit;
}







