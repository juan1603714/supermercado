<?php
include '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]); // Lee el archivo
    } else {
        die("Error al subir la imagen.");
    }

    $stmt = $conexion->prepare("INSERT INTO categorias (nombre, imagen) VALUES (?, ?)");
    $stmt->bind_param("sb", $nombre, $imagen);
    
    if ($stmt->execute()) {
        echo "Categoría agregada con éxito.";
        header("Location: ../vista/categorias.php");
    } else {
        echo "Error al agregar la categoría.";
    }
}
?>
