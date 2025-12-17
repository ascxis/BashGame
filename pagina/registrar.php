<?php
session_start();

$errors = [
    'registrar' => $_SESSION['registrer_error'] ?? '',
];

$activeForm = $_SESSION['active_form'] ?? 'registro';


unset($_SESSION['registrer_error'], $_SESSION['active_form']);

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="logo/image.png">
</head>

<body>

    <div class="logo">
        <img src="logo/image.png" alt="Bash game" width="400" height="400">
    </div>

    <form action="login_registro.php" method="post">
        <div class="login">
            <h1>Registrar</h1>
            <?= showError($errors['registrar']); ?>

            <div class="InputBox">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <i class='bx bx-user'></i>
            </div>

            <div class="InputBox">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bx-envelope'></i>
            </div>

            <div class="InputBox">
                <input type="password" name="password" placeholder="Contraseña" required>
                <i class='bx bx-lock'></i>
            </div>

            <button type="submit" class="boton" name="registrar">Registrar</button>

            <div class="link">
                <p class="a">¿Tienes cuenta? <a href="login.php">Iniciar Sesion</a></p>
            </div>
        </div>
    </form>

</body>

</html>