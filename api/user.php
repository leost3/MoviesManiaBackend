<?php

require_once "../classes/User.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = [];
    $action = $data['action'];
    $username = $data['username'];
    $password = $data['password'];

    switch ($action) {
        case 'login':
            $result = User::Login($username, $password); // true
            break;
        case 'register':
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];
            $userObj = new User($firstName, $lastName, $email, $username, $password, 2);
            $userObj->Insert();
            $result = "Created";
            break;
        case 'rating':
            echo json_enconde('rated');
        }
        echo json_encode(["result" => $result]);
}

