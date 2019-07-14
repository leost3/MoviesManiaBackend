<?php

require_once "../classes/User.php";
require_once "../classes/Movies.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    // $result = [];
    $ID = "";
    $Title = "";
    $Avg_rating = "";
    $moviesCollection = $data['moviesInfo'];
    // print_r($moviesCollection);

    foreach ($moviesCollection as $value) {
        $ID = $value['id'];
        $Title = $value['title'];
        $movieObj = new Movie($ID,$Title);
        $movieObj->Insert();
    }
    // echo json_encode(["result" => $movieObj]);
}