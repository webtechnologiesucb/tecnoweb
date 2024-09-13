<?php
include 'db.php';

$id = $_POST['id'];

$sql = "DELETE FROM category WHERE category_id = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
} else {
    echo 'Error en la preparación de la declaración: ' . $mysqli->error;
}
