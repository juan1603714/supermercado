<?php
include_once  
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["usuario_id"];
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    if (empty($nombre) || empty($correo)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $correo, $password_hash, $id);
    } else {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $correo, $id);
    }

    if ($stmt->execute()) {
        $_SESSION["usuario_nombre"] = $nombre;
        $_SESSION["usuario_correo"] = $correo;
        echo "Perfil actualizado correctamente.";
    } else {
        echo "Error al actualizar el perfil.";
    }

    $stmt->close();
}
?>
