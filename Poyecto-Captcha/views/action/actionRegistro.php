<?php

include_once '../../controller/ABMusuario.php';
include_once '../utils/datasubmitted.php';
include_once '../../validar.php';

$datos = datasubmitted();

// Verificar si se ha enviado el formulario
if ($datos) {

    // Obtener los datos del formulario
    $nombreUsuario = isset($datos['name']) ? $datos['name'] : null;
    $password = isset($datos['password']) ? $datos['password'] : null;
    $email = isset($datos['email']) ? $datos['email'] : null;
    //verificacion del captcha
    $captcha = isset($datos['g-recaptcha-response']) ? $datos['g-recaptcha-response'] : null;

    // Depuración de datos(muestra los datos para verificar que se reciben correctamente)
    
    echo "Nombre de Usuario: $nombreUsuario <br>";
    echo "Email: $email <br>";
    echo "Contraseña: $password <br>";
    echo "Captcha: $captcha <br>";

    // Validar que no haya campos vacíos
    if ($nombreUsuario && $password && $email && $captcha) {

        // Validar el reCAPTCHA
        if (!validar($captcha)) {
            echo 'Por favor, verifica el CAPTCHA.';
            exit;
        }

        // Instanciar el ABMUsuario para gestionar el registro
        $abmUsuario = new ABMUsuario();

        // Crear el array de datos
        $datosUsuario = [
            'id' => '', // autoincrement en base de datos
            'nombreUsuario' => $nombreUsuario,
            'password' => password_hash($password, PASSWORD_DEFAULT), // hash para el password
            'email' => $email,

        ];

        // Llamar a la función `abm` para registrar el nuevo usuario
        if ($abmUsuario->abm($datosUsuario)) {
            echo "Registro exitoso!";
        } else {
            echo "Error al registrar el usuario.";
        }
    } else {
        echo "Por favor complete todos los campos.";
    }
} else {
    echo "Método no permitido.";
}
