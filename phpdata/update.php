<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE category SET name = :name WHERE category_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $name, 'id' => $id]);
