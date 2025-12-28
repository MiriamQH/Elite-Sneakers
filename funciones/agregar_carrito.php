<?php
session_start();
require_once '../config/conexion.php'; // Asegúrate de que la ruta es correcta

if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    
    $producto_id = mysqli_real_escape_string($conn, $_POST['id']);
    $cantidad = intval($_POST['cantidad']);

    // Buscamos los datos completos del producto
    $sql = "SELECT id, nombre, precio, imagen FROM productos WHERE id = '$producto_id'";
    $resultado = mysqli_query($conn, $sql);
    $producto = mysqli_fetch_assoc($resultado);

    if ($producto) {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Comprobar si ya existe para sumar cantidad
        $encontrado = false;
        foreach ($_SESSION['carrito'] as $indice => $item) {
            // Verificamos que sea un array antes de acceder al ID
            if (is_array($item) && $item['id'] == $producto_id) {
                $_SESSION['carrito'][$indice]['cantidad'] += $cantidad;
                $encontrado = true;
                break;
            }
        }

        // Si es nuevo, guardamos el ARRAY completo, no solo el número
        if (!$encontrado) {
            $_SESSION['carrito'][] = [
                'id'       => $producto['id'],
                'nombre'   => $producto['nombre'],
                'precio'   => $producto['precio'],
                'imagen'   => $producto['imagen'],
                'cantidad' => $cantidad
            ];
        }
        $_SESSION['mensaje'] = "¡Producto añadido!";
    }
}
header("Location: ../carrito.php");
exit();