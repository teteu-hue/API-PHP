<?php

// dependencies
require_once('inc/config.php');
require_once('inc/api_functions.php');
require_once('../api/inc/database.php');

$variables = [
    'nome' => 'joao',
    'apelido' => 'ribeiro'
];

$response = api_request('status', 'GET', $variables);

echo '<pre>';
print_r($response);