<?php
// dependencies
require_once(dirname(__FILE__) . '/inc/database.php');
require_once(dirname(__FILE__) . '/inc/api_class.php');

$api = new api_response();

// check if method is valid
if(!$api->check_method($_SERVER['REQUEST_METHOD']))
{
    $api->set_method($_SERVER['REQUEST_METHOD']);
    $api->api_request_error('METHOD NOT FOUND!');
}

// set request method
$api->set_method($_SERVER['REQUEST_METHOD']);

if($api->get_method() == 'GET'){
    $api->set_endpoint($_GET['endpoint']);
} else if ($api->get_method() == 'POST'){
    $api->set_endpoint($_POST['endpoint']);
}

// routes

$api->send_api_status();
