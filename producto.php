<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}

include_once 'conexion.php';

// Obtener productos desde la base de datos
$sql = "SELECT * FROM productos";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .container {
            margin-top: 20px;
        }
        .table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-custom {
            background: #007bff;
            color: white;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="supermercado.php">Supermercado</a>
        <div class="navbar-nav ms-auto">
            <a href="producto.php" class="btn btn-primary mx-2">Productos</a>
            <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="mt-4 text-center">Gestión de Productos</h2>

    <!-- Formulario para agregar productos -->
    <form id="productForm" action="agregar.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>

    <!-- Tabla de productos -->
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $result->fetch_assoc()): ?>
            <tr>
                <td><img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" alt="Producto"></td>
                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                <td>$<?= number_format($producto['precio'], 2) ?></td>
                <td>
                    <a href="editar.php?id=<?= $producto['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="eliminarproductos.php?id=<?= $producto['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
