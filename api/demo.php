<?php
    // // $content = $_POST["content"];
    $content = "leo is a developer";
    $response = array("success" => true, "message"=>$content);
    echo json_encode($response);