<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/zepto@1.2.0/dist/zepto.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">CRUD Tabla Categoria</h2>
        <button class="btn btn-primary" onclick="crearCat()">Agregar Categoria</button>
        <div id="categoryTable"></div>
    </div>

    <script>
        $(document).ready(function() {
            cargarCategorias();
        });

        function cargarCategorias() {
            $.get('read.php', function(data) {
                $('#categoryTable').html(data);
            });
        }

        function crearCat() {
            Swal.fire({
                title: 'Agregar Categoria',
                html: '<input id="name" class="swal2-input" placeholder="Nombre">',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const name = $('#name').val();
                    if (!name) {
                        Swal.showValidationMessage('Ingrese nombre de categoria');
                    }
                    return { name: name };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('create.php', result.value, function() {
                        loadCategories();
                        Swal.fire('Guardado!', '', 'success');
                    });
                }
            });
        }

        function actualizarCat(id, name) {
            Swal.fire({
                title: 'Editar Categoria',
                html: '<input id="name" class="swal2-input" value="' + name + '">',
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const newName = $('#name').val();
                    if (!newName) {
                        Swal.showValidationMessage('Por favor ingrese una categoria');
                    }
                    return { id: id, name: newName };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('update.php', result.value, function() {
                        cargarCategorias();
                        Swal.fire('Actualizado!', '', 'success');
                    });
                }
            });
        }

        function eliminarCat(id) {
            Swal.fire({
                title: 'Estas seguro?',
                text: "No puedes deshacer esta eliminación!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('delete.php', { id: id }, function() {
                        cargarCategorias();
                        Swal.fire('Eliminado!', '', 'success');
                    });
                }
            });
        }

    </script>
</body>
</html>
