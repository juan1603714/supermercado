<?php
include_once '../config/conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);

    $stmt = $conexion->prepare("SELECT id, nombre, correo, contraseña, rol_nombre FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($contraseña, $usuario["contraseña"])) {
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nombre"] = $usuario["nombre"];
        $_SESSION["usuario_correo"] = $usuario["correo"];
        $_SESSION["usuario_rol"] = $usuario["rol_nombre"]; // Guardar rol en la sesión

        // **Redirigir SIEMPRE a supermercado.php**
        header("Location: ../vista/supermercado.php");
        exit();
    } else {
        echo "<script>alert('⚠️ Correo o contraseña incorrectos.'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
}
?>
