<?php
if (!isset($_GET['game'])) {
    header("Location: index.php");
    exit;
}

$game = basename($_GET['game']);
$gamePath = "juegos/" . $game;

if (!file_exists($gamePath)) {
    die("El juego no existe.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Jugando...</title>
<link rel="icon" href="/pagina/logo/image.png">

<script src="https://unpkg.com/@ruffle-rs/ruffle"></script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #ff4fcf;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    font-family: Arial, sans-serif;
}

#game-wrapper {
    width: 800px;
    height: 600px;
    background: black;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,.6);
}

#ruffle-player,
ruffle-player,
canvas {
    width: 100%;
    height: 100%;
}

.game-buttons {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.game-buttons button,
.game-buttons a {
    background: #7c3aed;
    color: white;
    padding: 12px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    border: none;
    cursor: pointer;
    font-size: 15px;
}

.game-buttons button:hover,
.game-buttons a:hover {
    background: #5b21b6;
}

body.fullscreen-active {
    background: black;
    overflow: hidden;
}

body.fullscreen-active #game-wrapper {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    border-radius: 0;
    box-shadow: none;
    z-index: 9999;
}

body.fullscreen-active .game-buttons {
    display: none;
}

</style>
</head>

<body>

<div id="game-wrapper">
    <div id="ruffle-player"></div>
</div>

<div class="game-buttons">
    <button onclick="activarPantallaCompleta()">⛶ Pantalla completa</button>
    <a href="index.php">← Volver al menú</a>
</div>

<script>
const ruffle = window.RufflePlayer.newest();
const player = ruffle.createPlayer();

player.style.width = "100%";
player.style.height = "100%";

document.getElementById("ruffle-player").appendChild(player);
player.load("<?= $gamePath ?>");

function activarPantallaCompleta() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().then(() => {
            document.body.classList.add("fullscreen-active");
        });
    }
}

document.addEventListener("fullscreenchange", () => {
    if (!document.fullscreenElement) {
        document.body.classList.remove("fullscreen-active");
    }
});
</script>

</body>
</html>








