<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}

// Verifica si los datos del usuario están en la sesión
if (!isset($_SESSION["usuario_nombre"]) || !isset($_SESSION["usuario_correo"])) {
    echo "<script>alert('Error: No se encontró la información del usuario.'); window.location.href = 'index.php';</script>";
    exit();
}

$usuario_rol = $_SESSION["usuario_rol"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../publico/supermercado.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar con menú dinámico según el rol -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../vista/supermercado.php">Supermercado</a>
            <div class="navbar-nav ms-auto">
                <a href="../vista/producto.php" class="btn btn-primary mx-2">Productos</a>

                <?php if ($usuario_rol == "Administrador" || $usuario_rol == "Vendedor") : ?>
                    <a href="../vista/proveedor.php" class="btn btn-primary mx-2">Proveedores</a>
                <?php endif; ?>

                <?php if ($usuario_rol == "Administrador") : ?>
                    <a href="../vista/categorias.php" class="btn btn-primary mx-2">Categorías</a>
                <?php endif; ?>

                <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
                <a href="../modelo/logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Sección de Bienvenida -->
    <div class="container content-container">
        <div class="welcome-section">
            <h2>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h2>
            <p>Explora nuestras categorías, encuentra los mejores productos y aprovecha ofertas exclusivas.</p>
        </div>
    </div>

    <!-- Modal de Perfil -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perfilModalLabel">Perfil de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="perfilForm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($_SESSION['usuario_correo']); ?>" disabled>
                        </div>
                        <button type="button" id="editarPerfil" class="btn btn-primary">Editar</button>
                        <button type="submit" id="guardarPerfil" class="btn btn-success d-none">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Supermercado. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../publico/supermercado.js"></script>

</body>
</html>
