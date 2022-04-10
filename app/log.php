<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: authorization');
header('Access-Control-Allow-Credentials: true');



//var_dump(getallheaders());
$token = str_replace('Bearer ','', getallheaders()['authorization']);

echo json_encode([
    "token" => $token
]);



if($_SERVER["REQUEST_METHOD"] === "POST"){


    

}