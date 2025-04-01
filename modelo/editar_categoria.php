<?php
include_once '../config/conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $stmt = $conexion->prepare("UPDATE categorias SET nombre=?, imagen=? WHERE id=?");
        $stmt->bind_param("sbi", $nombre, $imagen, $id);
    } else {
        $stmt = $conexion->prepare("UPDATE categorias SET nombre=? WHERE id=?");
        $stmt->bind_param("si", $nombre, $id);
    }
    if ($stmt->execute()) {
        header("Location: categorias.php");
    } else {
        echo "Error al actualizar categoría.";
    }
    $stmt->close();
}
?>
