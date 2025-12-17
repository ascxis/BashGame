<?php
require 'config.php';

$juegos = $conn->query("SELECT nombre, archivo, imagen FROM juegos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo/image.png">
    <link rel="stylesheet" href="index.css">
    <title>BlashGames</title>

    
</head>

<body>

<header>
    <div class="logo-container">
        <img src="logo/logo.png" alt="Logo" class="logo-img">
        <h1>Biblioteca Web de Juegos Flash</h1>
    </div>

    <nav>
        <a href="login.php">Iniciar Sesión</a>
    </nav>
</header>

<main>
    <div class="main-grid">

        
        <section class="title-section">
            <h2 class="main-title">Blash Games</h2>
        </section>

        
        <section class="games-section">

            <div class="games-grid">
                <?php if ($juegos->num_rows > 0): ?>
                    <?php while ($juego = $juegos->fetch_assoc()): ?>
                        <div class="game-card">
                            <a href="loader.php?game=<?= urlencode($juego['archivo']) ?>">
                                <img 
                                    src="<?= htmlspecialchars($juego['imagen']) ?>" 
                                    alt="<?= htmlspecialchars($juego['nombre']) ?>" 
                                    class="game-image"
                                >
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="sin-juegos">No hay juegos disponibles</p>
                <?php endif; ?>
            </div>

        </section>

    </div>
</main>

</body>
</html>


