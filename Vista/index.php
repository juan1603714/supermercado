<?php
session_start();
if (isset($_SESSION["usuario_id"])) {
    header("Location: supermercado.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso - Supermercado</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <!-- Íconos FontAwesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Estilos personalizados -->
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: #f8f9fa;
    }
    .container {
      max-width: 400px;
      margin-top: 50px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      background: white;
      padding: 30px;
      text-align: center;
    }
    .btn-custom {
      background: #007bff;
      color: white;
      transition: all 0.3s ease-in-out;
    }
    .btn-custom:hover {
      background: #0056b3;
      transform: scale(1.05);
    }
    .btn-toggle {
      color: #007bff;
      cursor: pointer;
      font-weight: bold;
      transition: color 0.3s;
    }
    .btn-toggle:hover {
      color: #0056b3;
    }
    .icon {
      font-size: 50px;
      color: #007bff;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card">
      <i class="fas fa-shopping-cart icon"></i>
      <h2 class="mb-3">Supermercado</h2>
      
      <!-- Formulario de Inicio de Sesión -->
      <div id="loginForm">
        <h5 class="text-muted">Accede a tu cuenta</h5>
        <form action="../modelo/procesar_login.php" method="POST">
          <div class="mb-3 text-start">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label">Contraseña</label>
            <input type="password" name="contraseña" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-custom w-100"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
        </form>
        <p class="mt-3">¿No tienes cuenta? <span class="btn-toggle" onclick="toggleForm()">Regístrate aquí</span></p>
      </div>

      <!-- Formulario de Registro (Oculto por defecto) -->
      <div id="registerForm" class="hidden">
        <h5 class="text-muted">Crea una cuenta</h5>
        <form action="../modelo/procesar_registro.php" method="POST">
          <div class="mb-3 text-start">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label">Contraseña</label>
            <input type="password" name="contraseña" class="form-control" required>
          </div>
          <div class="mb-3 text-start">
            <label class="form-label">Rol</label>
            <select name="usuario_rol" class="form-control" required>
              <option value="Administrador">Administrador</option>
              <option value="Vendedor">Vendedor</option>
              <option value="Comprador">Comprador</option>
            </select>
          </div>
          <button type="submit" class="btn btn-custom w-100"><i class="fas fa-user-plus"></i> Registrarse</button>
        </form>
        <p class="mt-3">¿Ya tienes cuenta? <span class="btn-toggle" onclick="toggleForm()">Inicia sesión aquí</span></p>
      </div>
    </div>
  </div>

  <script>
    // Función para alternar entre el formulario de login y el formulario de registro
    function toggleForm() {
      document.getElementById("loginForm").classList.toggle("hidden");
      document.getElementById("registerForm").classList.toggle("hidden");
    }
  </script>
</body>
</html>
