<?php
// Incluye el archivo que contiene la función datasubmitted
include_once __DIR__ . './datasubmitted.php';
   

// Obtiene los datos enviados
$datos = datasubmitted();

if ($datos) {
    // Extrae los datos del formulario
    $email = $datos['email'];
    $password = $datos['password'];
    $captcha = $datos['g-recaptcha-response'];

    // Verifica si el CAPTCHA está presente
    if (!$captcha) {
        echo 'Por favor, verifica el CAPTCHA.';
        exit;
    }

    // Función para validar el CAPTCHA con la API de Google
    function validar($captcha) {
        $secretKey = '6LfhnVkqAAAAAAYhv6_sMWmJTAwtMErZLcOiVPvV';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
        $responseKeys = json_decode($response, true);
    
        return intval($responseKeys['success']) === 1;
    }

    // Valida el CAPTCHA
    if (!validar($captcha)) {
        echo 'Verificación CAPTCHA fallida. Inténtalo de nuevo.';
    } else {
        // Procede con la validación del login, como verificar en la base de datos
        echo 'Acceso concedido. Bienvenido.';
    }
}
?>
