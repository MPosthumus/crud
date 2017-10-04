<?php
//joe
//Mysqli Connectie
$mysqli = new mysqli($host, $user, $pass, $db);
//Het gebruiken van de Create-Read-Update-Delete(CRUD) class
$crud = new CRUD($mysqli);

//Create functie
$query_str = "INSERT INTO table (field, field, field) VALUES (?, ?, ?)";
$types = "sis";
$params = array("string", "integer", "string");
$crud->create($query_str, $types, $params);

//Read functie
$query_str = "SELECT fields FROM table WHERE field=?";
$types = "s";
$params = array("string");
$crud->read($query_str, $types, $params);

//Update functie
$query_str = "UPDATE table SET field=? WHERE field=?";
$types = "si";
$params = array("string", "integer");
$crud->read($query_str, $types, $params);

//Delete functie
$query_str = "DELETE FROM table WHERE field=?";
$types = "i";
$params = array("integer");
$crud->read($query_str, $types, $params);

//Queries voor als je geen data mee wilt geven
$query_str = "SELECT * FROM table";
$query_str = "DELETE FROM table";
$crud->read($query_str);
?>