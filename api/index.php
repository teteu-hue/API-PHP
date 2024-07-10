<?php
// dependencies
require_once(dirname(__FILE__) . '/inc/api_database.php');
require_once(dirname(__FILE__) . '/inc/api_response.php');
require_once(dirname(__FILE__) . '/inc/api_logic.php');
require_once("./inc/Models/Client.class.php");

$api_response = new api_response();

// check if method is valid 
// if is not send a error message
if(!$api_response->check_method($_SERVER['REQUEST_METHOD']))
{
    $api_response->set_method($_SERVER['REQUEST_METHOD']);
    $api_response->api_request_error('METHOD NOT FOUND!');
}

// set request method
$api_response->set_method($_SERVER['REQUEST_METHOD']);

$params = null;

if($api_response->get_method() == 'GET'){
    $api_response->set_endpoint($_GET['endpoint']);
    // set the params in a GET 'method'
    $params = $_GET;
} else if ($api_response->get_method() == 'POST'){
    $api_response->set_endpoint($_POST['endpoint']);
    // set the params in a POST 'method'
    $params = $_POST;
}

// prepare the logic of api
$api_logic = new api_logic($api_response->get_endpoint(), $params);

if(!$api_logic->endpoint_exists()){
    $api_response->api_request_error('Inexist endpoint: '. $api_response->get_endpoint());
}

// request to the api_logic
$result = $api_logic->{$api_response->get_endpoint()}();
$api_response->add_to_data('data', $result);

$api_response->send_response();
