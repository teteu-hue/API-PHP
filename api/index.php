<?php

// temp response
header('Content-Type:application/json');

$data['method'] = $_SERVER['REQUEST_METHOD'];
$data['data'] = "error";

// show the variables in $data (GET OR POST).
if ($data['method'] == 'GET') {
    if (isset($_GET['endpoint'])) { 
        $data['data'] = $_GET;
    } else {
        $data['data'] = "ERROR";
    }
} else if ($data['method'] == 'POST') {
    $data['data'] = $_POST;
}


echo json_encode($data);
