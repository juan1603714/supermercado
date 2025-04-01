<?php
include_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];

    $stmt = $conexion->prepare("INSERT INTO provedores(nombre, telefono) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $telefono);

    if ($stmt->execute()) {
        echo "Proveedor agregado correctamente.";
    } else {
        echo "Error al agregar proveedor.";
    }
}
?>
