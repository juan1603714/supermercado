<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Raleway', sans-serif;
        }
        .content-container {
            flex: 1;
            padding: 20px;
        }
        /* Estilos para la sección de bienvenida */
        .welcome-section {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(to right, #ffcc00, #ff9900);
            color: white;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 900px;
            animation: fadeIn 1.5s ease-in-out;
        }
        .welcome-section h2 {
            font-size: 2.8rem;
            font-weight: bold;
            animation: slideUp 1s ease-out;
        }
        .welcome-section p {
            font-size: 1.2rem;
            margin-top: 10px;
            opacity: 0;
            animation: fadeIn 2s ease-in-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar (No se modifica) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="supermercado.php">Supermercado</a>
            <div class="navbar-nav ms-auto">
                <a href="producto.php" class="btn btn-primary mx-2">Productos</a>
                <a href="proveedor.php" class="btn btn-primary mx-2">Proveedores</a>
                <a href="categorias.php" class="btn btn-primary mx-2">Categorías</a>
                <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Sección de Bienvenida Mejorada -->
    <div class="container content-container">
        <div class="welcome-section">
            <h2>¡Bienvenido al Supermercado!</h2>
            <p>Explora nuestras categorías, encuentra los mejores productos y aprovecha ofertas exclusivas.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Supermercado. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
