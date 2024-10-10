<?php
$host = 'localhost';
$db = 'sakila';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Conexion Fallida: " . $mysqli->connect_error);
}