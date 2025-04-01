<?php
include_once '../config/conexion.php';

session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}

// Obtener todos los proveedores
$result = $conexion->query("SELECT * FROM provedores");
$proveedores = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="supermercado.php">Supermercado</a>
            <div class="navbar-nav ms-auto">
                <a href="producto.php" class="btn btn-primary mx-2">Productos</a>
                <a href="proveedor.php" class="btn btn-primary mx-2">Proveedores</a>
                <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4 text-center">Gestión de Proveedores</h2>

        <!-- Formulario para agregar proveedores -->
        <form id="agregarProveedorForm" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre del proveedor" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Agregar Proveedor</button>
                </div>
            </div>
        </form>

        <!-- Tarjetas de proveedores -->
        <div class="row">
            <?php foreach ($proveedores as $proveedor): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($proveedor["nombre"]) ?></h5>
                            <p class="card-text">📞 <?= htmlspecialchars($proveedor["telefono"]) ?></p>
                            <button class="btn btn-warning btn-sm" onclick="editarProveedor(<?= $proveedor['id'] ?>, '<?= $proveedor['nombre'] ?>', '<?= $proveedor['telefono'] ?>')">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarProveedor(<?= $proveedor['id'] ?>)">Eliminar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal para editar proveedor -->
    <div class="modal fade" id="editarProveedorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editarProveedorForm">
                        <input type="hidden" id="editarId">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editarNombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="editarTelefono" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Agregar proveedor
        document.getElementById("agregarProveedorForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            fetch("agregar_proveedor.php", { method: "POST", body: formData })
                .then(response => response.text())
                .then(() => location.reload());
        });

        // Editar proveedor
        function editarProveedor(id, nombre, telefono) {
            document.getElementById("editarId").value = id;
            document.getElementById("editarNombre").value = nombre;
            document.getElementById("editarTelefono").value = telefono;
            new bootstrap.Modal(document.getElementById("editarProveedorModal")).show();
        }

        document.getElementById("editarProveedorForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = new FormData();
            formData.append("id", document.getElementById("editarId").value);
            formData.append("nombre", document.getElementById("editarNombre").value);
            formData.append("telefono", document.getElementById("editarTelefono").value);
            fetch("editar_proveedor.php", { method: "POST", body: formData })
                .then(response => response.text())
                .then(() => location.reload());
        });

        // Eliminar proveedor
        function eliminarProveedor(id) {
            if (confirm("¿Estás seguro de eliminar este proveedor?")) {
                fetch("eliminar_proveedor.php?id=" + id, { method: "GET" })
                    .then(() => location.reload());
            }
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
