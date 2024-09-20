<?php
$host = 'localhost';
$db = 'sakila';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Fallo la conexion: " . $mysqli->connect_error);
}