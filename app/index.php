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
$db = new Dao();

$result = $db->runSelectQuery('SELECT * from Users')->fetchAll();

echo '<pre>';
print_r($response);

print_r($result);