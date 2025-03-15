<?php
include_once 'conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: producto.php");
    } else {
        echo "Error al eliminar el producto.";
    }
}
?>
