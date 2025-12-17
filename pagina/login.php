<?php
session_start();


$errors = [
    'login' => $_SESSION['login_error'] ?? '',
];


unset($_SESSION['login_error']);

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="logo/image.png">
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="logo/image.png" alt="Bash game" width="400" height="400">
        </div>

        <form action="login_registro.php" method="post" class="login">

            <h1>Inicio de Sesión</h1>


            <?= showError($errors['login']); ?>

            <div class="InputBox">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bx-envelope'></i>
            </div>

            <div class="InputBox">
                <input type="password" name="password" placeholder="Contraseña" required>
                <i class='bx bx-lock'></i>
            </div>
            <button type="submit" class="boton" name="login">Iniciar Sesión</button>

            <div class="link">
                <!--<p>¿No tienes una cuenta? <a href="registrar.php">Registrar</a></p>-->
                <p class="a">¿Olvidaste tu contraseña? <a href="#">Recuperar</a></p>
            </div>

        </form>
    </div>

</body>

</html>