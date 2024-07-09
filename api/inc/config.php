<?php

define("BASE_SELECT_QUERY_PRODUCT", "SELECT p.id_product AS id, p.name, p.description, p.price, p.stock_quantity, c.name as categorie, status 
                      FROM products p 
                      INNER JOIN categories c ON c.id_categorie = p.id_categorie");
define("BASE_SELECT_QUERY_USERS", "SELECT username AS user, email, role FROM Users");
define("BASE_SELECT_QUERY_CLIENTS", "SELECT * FROM Clients");
define("BASE_INSERT_QUERY_CLIENT", "CALL insert_customer()");