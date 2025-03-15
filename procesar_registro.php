<?php
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);

    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        echo "<script>alert('Completa todos los campos.'); window.location.href = 'index.php';</script>";
        exit();
    }

    // Verificar que el correo no esté registrado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.location.href = 'index.php';</script>";
        exit();
    }
    $stmt->close();

    // Cifrar la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contraseña_hash);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso. Ahora inicia sesión.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar.'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
}
?>
