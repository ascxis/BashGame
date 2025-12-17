<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    // ARCHIVO SWF
    $swf = $_FILES['archivo'];
    $swfNombre = basename($swf['name']);
    $swfDestino = "../juegos/" . $swfNombre;

    // IMAGEN
    $imagen = $_FILES['imagen'];
    $imgNombre = basename($imagen['name']);
    $imgDestino = "../logosgames/" . $imgNombre;

    if (
        move_uploaded_file($swf['tmp_name'], $swfDestino) &&
        move_uploaded_file($imagen['tmp_name'], $imgDestino)
    ) {
        $rutaSwf = $swfNombre;
        $rutaImagen = "logosgames/" . $imgNombre;

        $stmt = $conn->prepare(
            "INSERT INTO juegos (nombre, archivo, imagen) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $nombre, $rutaSwf, $rutaImagen);
        $stmt->execute();

        header("Location: dashboard.php");
        exit;
    } else {
        $mensaje = "Error al subir los archivos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Juego</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="/pagina/logo/image.png" type="image/png">
</head>
<body>

<div class="form-container">
    <h2>Agregar Nuevo Juego</h2>

    <?php if ($mensaje): ?>
        <p class="error"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="campo">
            <label>Nombre del juego</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="campo">
            <label>Archivo del juego (.swf)</label>
            <input type="file" name="archivo" accept=".swf" required>
        </div>

        <div class="campo">
            <label>Imagen del juego</label>
            <input type="file" name="imagen" accept="image/*" required>
        </div>

        <div class="acciones-form">
            <button type="submit" class="btn guardar">Guardar Juego</button>
            <a href="dashboard.php" class="btn cancelar">Cancelar</a>
        </div>

    </form>
</div>

</body>

</html>

