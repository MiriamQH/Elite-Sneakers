<?php
session_start();
require_once '../config/conexion.php'; 

// 1. Verificamos que el usuario esté logueado y el carrito no esté vacío
if (isset($_SESSION['usuario_id']) && isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

    // Usamos la variable definida en tu login.php
    $usuario_id = $_SESSION['usuario_id']; 
    
    // Recibimos datos del formulario o ponemos valores por defecto
    $provincia = isset($_POST['provincia']) ? mysqli_real_escape_string($conn, $_POST['provincia']) : 'Sin provincia';
    $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conn, $_POST['direccion']) : 'Sin dirección';
    
    // Calculamos el total en el servidor por seguridad
    $coste_total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $coste_total += ($item['precio'] * $item['cantidad']);
    }
    
    // 2. Insertamos el pedido principal
    $sql_pedido = "INSERT INTO pedidos (usuario_id, fecha, estado, total, provincia, direccion, hora) 
                   VALUES ($usuario_id, CURDATE(), 'confirmado', $coste_total, '$provincia', '$direccion', CURTIME())";
    
    $guardar = mysqli_query($conn, $sql_pedido);

    if ($guardar) {
        $pedido_id = mysqli_insert_id($conn);

        // 3. Recorremos el carrito para las líneas de pedido y el stock
        foreach ($_SESSION['carrito'] as $item) {
            $producto_id = $item['id'];
            $cantidad = $item['cantidad'];
            $precio_unitario = $item['precio'];

            // Insertamos cada par de zapatillas en la tabla de líneas
            $sql_linea = "INSERT INTO lineas_pedido (pedido_id, producto_id, unidades, precio_unitario) 
                          VALUES ($pedido_id, $producto_id, $cantidad, $precio_unitario)";
            mysqli_query($conn, $sql_linea);

            // 4. ACTUALIZACIÓN DE STOCK: Restamos las unidades compradas
            $sql_stock = "UPDATE productos SET stock = stock - $cantidad WHERE id = $producto_id";
            mysqli_query($conn, $sql_stock);
        }

        // 5. Vaciamos el carrito y redirigimos al éxito
        unset($_SESSION['carrito']);
        header("Location: ../pedido_exito.php");
        exit();
        
    } else {
        echo "Error al guardar el pedido: " . mysqli_error($conn);
    }

} else {
    // Si no hay sesión o carrito, volvemos al inicio
    header("Location: ../index.php");
    exit();
}
?>