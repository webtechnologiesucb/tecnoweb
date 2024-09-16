<?php
include 'db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permitir acceso desde cualquier origen
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS'); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet($mysqli);
        break;
    case 'POST':
        handlePost($mysqli);
        break;
    case 'PATCH':
        handlePatch($mysqli);
        break;
    case 'DELETE':
        handleDelete($mysqli);
        break;
    default:
        echo json_encode(['message' => 'Metodo no soportado']);
        break;
}

function handleGet($mysqli)
{
    $category_id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($category_id) {
        $stmt = $mysqli->prepare("SELECT * FROM category WHERE category_id = ? AND isDeleted = 0");
        $stmt->bind_param("i", $category_id);
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM category WHERE isDeleted = 0");
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $categories = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($categories);
}

function handlePost($mysqli)
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['name'])) {
        $stmt = $mysqli->prepare("INSERT INTO category (name, isDeleted) VALUES (?,0)");
        $stmt->bind_param("s", $data['name']);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Categoría creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al crear la categoría"]);
        }
    } else {
        echo json_encode(["message" => "Datos incompletos"]);
    }
}

function handlePatch($mysqli)
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['id']) && !empty($data['name'])) {
        $stmt = $mysqli->prepare("UPDATE category SET name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $data['name'], $data['id']);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Categoría actualizada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar la categoría"]);
        }
    } else {
        echo json_encode(["message" => "Datos incompletos"]);
    }
}

function handleDelete($mysqli)
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['id'])) {
        $stmt = $mysqli->prepare("DELETE FROM category WHERE category_id = ?");
        $stmt->bind_param("i", $data['id']);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Categoría eliminada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar la categoría"]);
        }
    } else {
        echo json_encode(["message" => "ID no proporcionado"]);
    }
}