<?php
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];

    $stmt = $conexion->prepare("UPDATE proveedores SET nombre=?, telefono=? WHERE id=?");
    $stmt->bind_param("ssi", $nombre, $telefono, $id);

    if ($stmt->execute()) {
        echo "Proveedor actualizado.";
    } else {
        echo "Error al actualizar.";
    }
}
?>
