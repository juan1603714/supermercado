<?php
include_once 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de entrada
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);

    // Preparar consulta para obtener los datos del usuario
    $stmt = $conexion->prepare("SELECT id, nombre, correo, contraseña, rol_nombre FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
  

    // Verificar si el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($contraseña, $usuario["contraseña"])) {
        // Guardar la información del usuario en la sesión
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nombre"] = $usuario["nombre"];
        $_SESSION["usuario_correo"] = $usuario["correo"];
        $_SESSION["usuario_rol"] = $usuario["rol_nombre"]; // Guardamos el rol como rol_nombre en la sesión

        // Redirigir al usuario según su rol
        switch ($usuario["rol_nombre"]) {
            case "Administrador":
                // Redirigir a la página del Administrador
                header("Location: supermercado.php");
                break;
            case "Vendedor":
                // Redirigir a la página del Vendedor
                header("Location: vendedor.php");
                break;
            case "Comprador":
                // Redirigir a la página del Comprador
                header("Location: comprador.php");
                break;
            default:
                // Si el rol no es válido, mostrar un mensaje de error
                echo "<script>alert('Rol no válido.'); window.location.href = 'index.php';</script>";
                break;
        }
        exit(); // Asegurarse de que no se ejecute más código después de la redirección
    } else {
        // Si el correo o la contraseña son incorrectos
        echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
}
?>

