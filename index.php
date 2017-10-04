<?php
require_once 'class.crud.php';

$host = "localhost";
$user = "root";
$pass = "123";
$db = "cms_systeem";

$mysql = new mysqli($host, $user, $pass, $db);

$crud = new CRUD($mysql);

$query_str = "SELECT fields FROM table WHERE field=?";
$types = "s";
$params = array("string");
echo $crud->read($query_str, $types, $params);