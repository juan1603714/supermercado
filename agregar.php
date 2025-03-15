<?php
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);
        
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, precio, imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $nombre, $precio, $imagen);
        
        if ($stmt->execute()) {
            header("Location: producto.php");
        } else {
            echo "Error al agregar producto.";
        }
    } else {
        echo "Error al subir imagen.";
    }
}
?>
