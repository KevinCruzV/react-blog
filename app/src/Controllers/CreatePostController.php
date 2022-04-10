<?php
namespace App\Controllers;

require './../../vendor/autoload.php';

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: authorization');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Entity\Post;



$requestMethod = $_SERVER["REQUEST_METHOD"];

$post = new PostManager((new PDOFactory())->getMysqlConnection());

$data = json_decode(file_get_contents("php://input"));

$newPost = new Post(2, $data->title, $data->content);

if(strtoupper($requestMethod) == "POST")

{
    die();

    if($post->createPost($newPost)){
        http_response_code(201);

        echo json_encode(["Post has been added to the database"]);


    }
    else
    {
        http_response_code(501);
        echo json_encode(["Post not sent"]);
    }


}    

else {

    http_response_code(405);
    echo "Method Not Allowed";
    die();

}
