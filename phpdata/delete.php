<?php
include 'db.php';

$id = $_POST['id'];

$sql = "UPDATE category SET isDeleted=1 WHERE category_id = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
} else {
    echo 'Error en la preparación de la declaración: ' . $mysqli->error;
}
