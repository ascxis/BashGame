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

$stmt = $conn->prepare("SELECT imagen FROM juegos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: dashboard.php");
    exit;
}

$juego = $result->fetch_assoc();

if (!empty($juego['imagen'])) {
    $ruta = "../" . $juego['imagen'];
    if (file_exists($ruta)) {
        unlink($ruta);
    }
}

$delete = $conn->prepare("DELETE FROM juegos WHERE id = ?");
$delete->bind_param("i", $id);
$delete->execute();

header("Location: dashboard.php");
exit;

