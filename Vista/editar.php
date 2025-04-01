<?php
include_once '../config/conexion.php';


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto inválido.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    if (!empty($_FILES["imagen"]["tmp_name"])) {
        $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);
        $stmt = $conexion->prepare("UPDATE productos SET nombre=?, precio=?, imagen=? WHERE id=?");
        $stmt->bind_param("sdsi", $nombre, $precio, $imagen, $id);
    } else {
        $stmt = $conexion->prepare("UPDATE productos SET nombre=?, precio=? WHERE id=?");
        $stmt->bind_param("sdi", $nombre, $precio, $id);
    }

    if ($stmt->execute()) {
        header("Location: producto.php");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Editar Producto</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen actual</label><br>
                <img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" width="100">
            </div>
            <div class="mb-3">
                <label class="form-label">Nueva Imagen (opcional)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="producto.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
