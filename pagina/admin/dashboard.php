<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

$juegos = $conn->query("SELECT id, nombre FROM juegos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="/pagina/logo/image.png" type="image/png">
</head>
<body>

<header class="navbar">
    <h2>Admin:  <?= $_SESSION['user_name'] ?? 'Admin'; ?> </h2>
    <div class="user">
        
        <a href="logout.php" class="btn-salir">Salir</a>
    </div>
</header>

<section class="contenedor">
    <h1>Panel de Administración</h1>

    <h2 style="margin-top: 20px;">Juegos Registrados</h2>

    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Juego</th>
                <th class="col-accion">
                    <div class="accion-header">ACCIÓN</div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($juegos->num_rows > 0): ?>
                <?php while ($juego = $juegos->fetch_assoc()): ?>
                    <tr>
                        <td><?= $juego['id']; ?></td>
                        <td><?= htmlspecialchars($juego['nombre']); ?></td>
                        <td class="acciones">
                            <a href="editar_juego.php?id=<?= $juego['id']; ?>" class="btn-tabla modificar">
                            Modificar
                            </a>
                            <a href="eliminar_juego.php?id=<?= $juego['id']; ?>"
                            class="btn-tabla eliminar"
                            onclick="return confirm('¿Eliminar este juego?')">
                            Eliminar
                            </a>
                            </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay juegos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="agregar-juego-wrapper">
    <a href="agregar_juego.php" class="btn-agregar-juego">
        Agregar Juego
    </a>
</div>
</section>

</body>
</html>
