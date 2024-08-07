<?php
// dependencies
require_once('config.php');
require_once('api_functions.php');

$data = api_request("get_all_clients");

echo "<pre>";
var_dump($data['data']['body']);

// logic and 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Admin - Clientes</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
</head>
<body>

<?php include('nav.php'); ?>

<section class="container mt-5">
    <div class="row">
        <div class="col">
            <h1>Clientes</h1>
            <hr>
            <table class="table table-striped table-hover table-bordered caption-top">
                <caption>Lista de clientes</caption>
                <thead class="table-info">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($data['data']['body'] as $row)
                    {
                        echo "<tr>";

                        echo "<td scope='row'>" . $row['id_client'] . "</td>";  
                        echo "<td>" . $row['name'] . "</td>";  
                        if($row['address'] == NULL){
                            echo "<td class='text-danger'>" . "Não informado" . "</td>";  
                        } else {
                            echo "<td>" . $row['address'] . "</td>";  
                        }

                        if($row['phone'] == NULL){
                            echo "<td class='text-danger'>" . "Não informado" . "</td>";  
                        } else {
                            echo "<td>" . $row['phone'] . "</td>";  
                        }

                        if($row['status'] == 1) {

                            echo "<td class='text-success'>" . "Ativo" . "</td>";  
                        } else {
                            echo "<td class='text-danger'>" . "Inativo" . "</td>";  
                        }

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
    
<script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
