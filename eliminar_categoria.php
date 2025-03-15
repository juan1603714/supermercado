<?php
include_once 'conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion->query("DELETE FROM categorias WHERE id = $id");
    header("Location: categorias.php");
}
?>
