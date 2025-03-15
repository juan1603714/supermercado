<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Error: No has iniciado sesión.";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$password = trim($_POST['password']);

if (empty($nombre) || empty($correo)) {
    echo "Todos los campos son obligatorios.";
    exit();
}

if (!empty($password)) {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $correo, $passwordHash, $usuario_id);
} else {
    $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $correo, $usuario_id);
}

if ($stmt->execute()) {
    $_SESSION['usuario_nombre'] = $nombre;
    $_SESSION['usuario_correo'] = $correo;
    echo "Perfil actualizado correctamente.";
} else {
    echo "Error al actualizar el perfil.";
}

$stmt->close();
?>
