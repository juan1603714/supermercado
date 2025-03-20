<?php
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];

    if (empty($id) || empty($nombre) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    $stmt = $conexion->prepare("UPDATE provedores SET nombre = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $telefono, $id);

    if ($stmt->execute()) {
        echo "Proveedor actualizado correctamente.";
    } else {
        echo "Error al actualizar proveedor.";
    }

    $stmt->close();
}
?>
