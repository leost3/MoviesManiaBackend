<?php
require_once "classes/User.php";

/* header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
 */

//$entityBody = file_get_contents('php://input');
//var_dump($_REQUEST);die;
$method = $_SERVER['REQUEST_METHOD'];

//echo $method;
// var_dump($username,123);die;
$username = $_POST['username'];
$password = $_POST['password'];


$result = User::Login($username, $password);

header('Content-Type: application/json');

echo json_encode(["result" => $result ]);


