<?php
// config/conexion.php

$servidor = "localhost";
$usuario_db = "root";
$password_db = ""; 
$nombre_db = "elite_sneakers_db"; // ¡Verifica si es _bd o _db!

$conn = new mysqli($servidor, $usuario_db, $password_db, $nombre_db);

if ($conn->connect_error) {
    die("Fallo fatal de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Gestión de Sesiones 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>