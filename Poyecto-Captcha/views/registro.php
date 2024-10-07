
<?php
include_once './estructura/nav.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cuenta</title>
    <!-- Enlazamos Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- reCAPTCHA script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form action="/register" method="POST" class="p-4 shadow bg-white rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Crea tu cuenta</h3>
            <!-- Campo de nombre -->
            <div class="form-group mb-3">
                <label for="name"></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
            </div>

            <!-- Campo de correo -->
            <div class="form-group mb-3">
                <label for="email"></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
            </div>

            <!-- Campo de contraseña -->
            <div class="form-group mb-3">
                <label for="password"></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <!-- reCAPTCHA -->
            <div class="g-recaptcha mb-3" data-sitekey="6LfhnVkqAAAAAG7ueEm-vYRbLO1u2xLsECX_IOIF"></div>

            <!-- Botón de registro -->
            <button type="submit" class="btn btn-primary btn-block mt-3">Registrar</button>

            <!-- Enlace para iniciar sesión si ya tienes cuenta -->
            <p class="text-center mt-3">
                ¿Ya tienes cuenta? <a href="./login.php">Inicia sesión</a>
            </p>
        </form>
    </div>

    <!-- Enlazamos Bootstrap JS y dependencias -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
