<?php

require 'includes/config/database.php';
$db = conectarDB();
// Autenticar Usuario

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    // var_dump($email);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio";
    }

    if (!$password) {
        $errores[] = "El password es obligatorio";
    }

    if (empty($errores)) {
        // Revisar si el usuaario existe.
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resEmail = mysqli_query($db, $query);
        // var_dump($resEmail);

        if ($resEmail->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resEmail);

            // verrificar si el password es correcto
            $auth = password_verify($password, $usuario['password']);
            // var_dump($auth);
            if ($auth) {
                // el usuario esta autenticado
                session_start();
                // ahora llenamos el arrgelo de la session
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                // redireccionar al usuario cuando haya inicioado sesion
                header('Location: /admin');
            } else {
                $errores[] = 'El password es incorrecto';
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}



// Incluye el header
require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y password</legend>

            <label for="email">Correo</label>
            <input type="email" name="email" placeholder="Tu correo" id="email">

            <label for="password">Passeord</label>
            <input type="password" name="password" placeholder="Tu Contraseña" id="password">
        </fieldset>
        <input type="submit" value="iniciar Sesión" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplates('footer')
?>