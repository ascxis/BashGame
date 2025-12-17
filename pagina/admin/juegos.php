<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

$resultado = $conn->query("SELECT id, nombre FROM juegos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Juegos</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header class="navbar">
    <h2>BLASH GAMES - Admin</h2>
    <div class="user">
        <?= $_SESSION['user_name'] ?? 'Admin'; ?>
        <a href="../logout.php">Salir</a>
    </div>
</header>

<section class="contenedor">
    <h1>Lista de Juegos</h1>

    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Juego</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($juego = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $juego['id']; ?></td>
                        <td><?= $juego['nombre']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No hay juegos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

</body>
</html>
