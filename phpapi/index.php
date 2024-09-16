<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">CRUD Categoria</h2>
        <div id="tablaCategoria"></div>
        <button class="btn btn-primary" onclick="crearFormulario()">Agregar Categoria</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            cargarCategorias();
        });

        function cargarCategorias() {
            fetch('api.php')
                .then(response => response.json())
                .then(data => {
                    let table = '<table class="table table-bordered"><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>';
                    data.forEach(category => {
                        table += `<tr>
                            <td>${category.category_id}</td>
                            <td>${category.name}</td>
                            <td>
                                <button class="btn btn-warning" onclick="actualizarCat(${category.category_id}, '${category.name}')">Editar</button>
                                <button class="btn btn-danger" onclick="eliminarCat(${category.category_id})">Eliminar</button>
                            </td>
                        </tr>`;
                    });
                    table += '</table>';
                    document.getElementById('tablaCategoria').innerHTML = table;
                });
        }

        function crearFormulario() {
            const name = prompt('Ingrese nombre de categoria:');
            if (name) {
                fetch('api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ name: name })
                }).then(() => cargarCategorias());
            }
        }

        function actualizarCat(id, name) {
            const newName = prompt('Ingrese nombre de categoria:', name);
            if (newName) {
                fetch('api.php', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id, name: newName })
                }).then(() => cargarCategorias());
            }
        }

        function eliminarCat(id) {
            if (confirm('Estas seguro que deseas eliminar esta categoria?')) {
                fetch('api.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                }).then(() => cargarCategorias());
            }
        }
    </script>
</body>
</html>