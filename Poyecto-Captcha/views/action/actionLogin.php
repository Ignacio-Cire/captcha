<?php
include_once '../model/Usuario.php'; // Asegúrate de que la ruta sea correcta
include_once '../control/ControlUsuario.php'; // Controlador que gestiona la lógica de usuario

$datos = datasubmitted(); // Función que captura datos del formulario

if ($datos) {
    $email = $datos['email'];
    $password = $datos['password'];
    $captcha = $datos['g-recaptcha-response'];

    // Verifica el CAPTCHA usando la función validar
    if (!validar($captcha)) {
        echo 'Por favor, verifica el CAPTCHA.';
        exit;
    }

    // Crear una instancia del ControlUsuario
    $controlUsuario = new ControlUsuario();
    
    // Autenticación de usuario
    $usuario = $controlUsuario->iniciarSesion($email, $password);

    if ($usuario) {
        // Autenticación exitosa
        session_start();
        $_SESSION['usuario'] = $usuario->getNombreUsuario(); // Guarda el nombre de usuario en sesión
        header("Location: ../vistas/dashboard.php"); // Redirige a una página de inicio o dashboard
        exit;
    } else {
        // Autenticación fallida
        echo 'Email o contraseña incorrectos.';
    }
} else {
    echo 'No se recibieron datos.';
}
?>
