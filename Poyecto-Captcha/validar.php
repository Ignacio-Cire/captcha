<?php
include_once './views/utils/datasubmitted.php';    

$datos = datasubmitted();

if ($datos){
    $email = $datos['email'];
    $password = $datos['password'];
    $captcha = $datos['g-recaptcha-response'];

    // Verifica si el CAPTCHA está presente
    if (!$captcha) {
        echo 'Por favor, verifica el CAPTCHA.';
        exit;
    }

    // Verificación con la API de Google
    $secretKey = '6LfhnVkqAAAAAAYhv6_sMWmJTAwtMErZLcOiVPvV';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys['success']) !== 1) {
        echo 'Verificación CAPTCHA fallida. Inténtalo de nuevo.';
    } else {
        // Aquí puedes proceder con la validación de login, como verificar en la base de datos
        echo 'Acceso concedido. Bienvenido.';
    }
}
?>
