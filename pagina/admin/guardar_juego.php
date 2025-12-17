<?php
require_once "../conexion.php";

$nombre = $_POST['nombre'];
$archivo = $_FILES['archivo'];

$carpeta = "../juegos/swf/";
$nombreArchivo = uniqid() . ".swf";
$rutaFinal = $carpeta . $nombreArchivo;

if ($archivo['type'] !== "application/x-shockwave-flash") {
    die("Archivo no permitido");
}

if (move_uploaded_file($archivo['tmp_name'], $rutaFinal)) {

    $sql = "INSERT INTO juegos (nombre, archivo) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $nombreArchivo);
    $stmt->execute();

    header("Location: index.php");
    exit;
} else {
    echo "Error al subir el archivo";
}
