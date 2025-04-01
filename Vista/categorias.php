<?php
include_once '../config/conexion.php';

session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../vista/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../vista/supermercado.php">Supermercado</a>
            <div class="navbar-nav ms-auto">
                <a href="producto.php" class="btn btn-primary mx-2">Productos</a>
                <a href="proveedor.php" class="btn btn-primary mx-2">Proveedores</a>
                <a href="categorias.php" class="btn btn-primary mx-2">Categorías</a>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2 class="text-center">Gestión de Categorías</h2>
        
        <!-- Formulario para agregar categoría -->
        <form action="../modelo/agregar_categoria.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Nombre de la Categoría</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Agregar Categoría</button>
        </form>
        
        <!-- Tabla de categorías -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conexion->query("SELECT * FROM categorias");
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($row['imagen']) ?>" width="100"></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td>
                            <a href="../modelo/editar_categoria.php?id=<?= $row['id'] ?>" class="btn btn-warning">Editar</a>
                            <a href="../modelo/eliminar_categoria.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>