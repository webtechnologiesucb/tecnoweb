<?php
include 'db.php';

$sql = "SELECT category_id, name, last_update FROM category";
$stmt = $pdo->query($sql);

echo '<table class="table table-bordered">';
echo '<tr><th>ID</th><th>Nombre</th><th>Fecha</th><th>Acciones</th></tr>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo '<tr>';
  echo '<td>' . $row['category_id'] . '</td>';
  echo '<td>' . $row['name'] . '</td>';
  echo '<td>' . $row['last_update'] . '</td>';
  echo '<td>
            <button class="btn btn-warning" onclick="actualizarCat(' . $row['category_id'] . ', \'' . $row['name'] . '\')">Editar</button>
            <button class="btn btn-danger" onclick="eliminarCat(' . $row['category_id'] . ')">Eliminar</button>
          </td>';
  echo '</tr>';
}
echo '</table>';
