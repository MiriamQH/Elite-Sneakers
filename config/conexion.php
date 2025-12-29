<?php
/**
 * CAPA DE ACCESO A DATOS - ELITE SNEAKERS
 * Versión optimizada para despliegue y desarrollo local.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Entorno LOCAL (XAMPP)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "elite_sneakers"; 
} else {
    // Entorno REAL (InfinityFree)
    $host = "sql312.infinityfree.com";     //
    $user = "if0_40784850";                 //
    $pass = "PONER_AQUI_CONTRASEÑA_HOSTING"; // <--- Por seguridad, en GitHub no pongas la real
    $db   = "if0_40784850_elitesneakersdb"; //
}

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
