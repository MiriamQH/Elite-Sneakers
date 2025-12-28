<?php
session_start();

if (isset($_GET['indice'])) {
    $indice = $_GET['indice'];
    
    if (isset($_SESSION['carrito'][$indice])) {
        // Eliminamos el producto del array
        unset($_SESSION['carrito'][$indice]);
        
        // Reindexamos el array para evitar huecos vacíos
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

header("Location: ../carrito.php");
exit();