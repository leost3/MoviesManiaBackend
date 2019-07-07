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
            echo json_encode(["isLoggedIn" => $result]);
            break;
        case 'register':
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];
            $userObj = new User($firstName, $lastName, $email, $username, $password, 2);
            $userObj->Insert();
            echo json_encode(["registration" => "created"]);
            break;
}
    // echo json_encode($data['data']);
}else {
    echo "isso eh um get";
}



// $action = $_POST['action'];


// $result = [];
// switch ($action) {
//     case 'login':
//         $username = $_POST['username'];
//         $password = $_POST['password'];

//         $result = User::Login($username, $password);
//     break;
// }

// header('Content-Type: application/json');

// echo json_encode(["result" => $_POST["action"] ]);