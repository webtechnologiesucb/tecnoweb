<?php
include 'db.php';

$id = $_POST['id'];

$sql = "DELETE FROM category WHERE category_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
