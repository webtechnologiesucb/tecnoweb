<?php
include 'db.php';

$name = $_POST['name'];

$sql = "INSERT INTO category (name) VALUES (:name)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $name]);
