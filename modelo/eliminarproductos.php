<?php
include_once '../config/conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../modelo/producto.php");
    } else {
        echo "Error al eliminar el producto.";
    }
}
?>
