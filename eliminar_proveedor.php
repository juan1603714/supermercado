<?php
include_once 'conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $conexion->prepare("DELETE FROM provedores WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Proveedor eliminado.";
    } else {
        echo "Error al eliminar.";
    }
}
?>
