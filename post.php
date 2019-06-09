<?php

/* header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
 */
// $data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
// print_r($_POST);

/* if($_SERVER['REQUEST_METHOD']==='POST'/*  && empty($_POST) ) {
    $_POST = json_decode(file_get_contents('http://php://input'));
    print_r($_POST);
} */


if (isset($_POST)) {
    // header("HTTP/1.1 200 success");
    // $resfponse['status'] = 200;
    // $response['status_message'] = "success";
    // $response['data'] = "Hi from PHP!";
    echo "listened from fontend";
    $resp = $_POST["data"];
    echo $resp;
}
//$_POST['variable_name'];

//$_POST["name"]
?>

