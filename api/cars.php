<?php

require_once "../classes/Car.php";

$action = $_POST['action'];

$result = [];
switch ($action) {
    case 'list':
        $result = Car::ReadCars();
    break;
}

header('Content-Type: application/json');

echo json_encode(["result" => $result ]);