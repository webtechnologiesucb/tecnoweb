<?php
include 'db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    case 'PATCH':
        handlePatch();
        break;
    case 'DELETE':
        handleDelete();
        break;
    default:
        echo json_encode(['message' => 'Method not supported']);
        break;
}

function handleGet()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM category WHERE isDeleted = 0");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categories);
}

function handlePost()
{
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO category (name) VALUES (:name)");
    $stmt->execute(['name' => $data['name']]);
    echo json_encode(['message' => 'Category created']);
}

function handlePatch()
{
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE category SET name = :name WHERE category_id = :id");
    $stmt->execute(['name' => $data['name'], 'id' => $data['id']]);
    echo json_encode(['message' => 'Category updated']);
}

function handleDelete()
{
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE category SET isDeleted = 1 WHERE category_id = :id");
    $stmt->execute(['id' => $data['id']]);
    echo json_encode(['message' => 'Category deleted']);
}