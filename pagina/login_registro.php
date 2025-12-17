<?php
session_start();
require 'config.php';

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        $_SESSION['login_error'] = "Todos los campos son obligatorios";
        header("Location: index.html");
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {

        $user = $resultado->fetch_assoc();

        if ($password === $user['password']) {

            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];

            header("Location: admin/dashboard.php");
            exit;

        } else {
            $_SESSION['login_error'] = "Contraseña incorrecta";
        }

    } else {
        $_SESSION['login_error'] = "Credenciales inválidas";
    }

    header("Location: login.html");
    exit;
}




