<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT nombre, imagen FROM juegos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: dashboard.php");
    exit;
}

$juego = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $imagen = $juego['imagen'];

    if (!empty($_FILES['imagen']['name'])) {
        $carpeta = "../logosgames/";

        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nuevoNombre = uniqid("game_") . "." . $ext;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nuevoNombre);
        $imagen = "logosgames/" . $nuevoNombre;
    }

    $update = $conn->prepare("UPDATE juegos SET nombre = ?, imagen = ? WHERE id = ?");
    $update->bind_param("ssi", $nombre, $imagen, $id);
    $update->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Juego</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="/pagina/logo/image.png">
</head>
<body>

<header class="navbar">
    <h2>BLASH GAMES - Admin</h2>
    <div class="user">
        <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?>
        <a href="logout.php" class="btn-salir">Salir</a>
    </div>
</header>

<section class="contenedor">

    <h1 class="titulo-morado">Modificar Juego</h1>

    <form method="POST" enctype="multipart/form-data" class="form-admin">

        <label>Nombre del Juego</label>
        <input 
            type="text" 
            name="nombre" 
            value="<?= htmlspecialchars($juego['nombre']) ?>" 
            required
        >

        <div class="imagen-actual-label">Imagen Actual</div>

        <img 
            src="../<?= htmlspecialchars($juego['imagen']) ?>" 
            class="preview-imagen" 
            alt="Imagen del juego"
        >

        <label>Cambiar Imagen</label>
        <input type="file" name="imagen" accept="image/*">

        <div class="form-botones">
            <button type="submit" class="btn-guardar">Guardar Juego</button>
            <a href="dashboard.php" class="btn-cancelar">Cancelar</a>
        </div>

    </form>

</section>

</body>
</html>



