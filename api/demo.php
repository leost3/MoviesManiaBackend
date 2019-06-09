<?php
    // // $content = $_POST["content"];
    $content = "Data from the backend";
    $response = array("success" => true, "message"=>$content);
    echo json_encode($response);