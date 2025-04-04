<?php
include_once '../config/conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);
    $usuario_rol = $_POST["usuario_rol"]; // Capturamos el rol del formulario

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo) || empty($contraseña) || empty($usuario_rol)) {
        echo "<script>alert('⚠️ Completa todos los campos.'); window.location.href = 'index.php';</script>";
        exit();
    }

    // Verificar que el correo no esté registrado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('⚠️ El correo ya está registrado. Inicia sesión.'); window.location.href = '../vista/index.php';</script>";
        exit();
    }
    $stmt->close();

    // Cifrar la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario con el rol seleccionado
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol_nombre) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $contraseña_hash, $usuario_rol);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Registro exitoso. Ahora inicia sesión.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar. Inténtalo de nuevo.'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
}
?>
