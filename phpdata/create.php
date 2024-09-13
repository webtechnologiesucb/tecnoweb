<?php
include 'db.php';

$name = $_POST['name'];

$sql = "INSERT INTO category (name) VALUES (?)";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();
} else {
    echo 'Error en la preparación de la declaración: ' . $mysqli->error;
}