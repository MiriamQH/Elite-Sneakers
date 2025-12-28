<?php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Borrado físico de la imagen 
    $res = $conn->query("SELECT imagen FROM productos WHERE id = '$id'");
    if ($fila = $res->fetch_assoc()) {
        $ruta = "../assets/img/" . $fila['imagen'];
        if (!empty($fila['imagen']) && file_exists($ruta)) {
            unlink($ruta); 
        }
    }

    // Borrado del registro
    $conn->query("DELETE FROM productos WHERE id = '$id'");
}

header("Location: gestion_productos.php");
exit();