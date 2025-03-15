<?php
include_once 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);

    // Seleccionamos también el campo 'correo'
    $stmt = $conexion->prepare("SELECT id, nombre, correo, contraseña FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($contraseña, $usuario["contraseña"])) {
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nombre"] = $usuario["nombre"];
        $_SESSION["usuario_correo"] = $usuario["correo"];  // Se guarda el correo en la sesión
        header("Location: supermercado.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
}
?>
