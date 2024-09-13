<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE category SET name = ? WHERE category_id = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $stmt->close();
} else {
    echo 'Error en la preparación de la declaración: ' . $mysqli->error;
}
