<?php
/**
 * CAPA DE LÓGICA DE NEGOCIO (PHP)
 * Manejo de autenticación de usuarios y control de sesiones.
 */

// Iniciamos la sesión para mantener el estado de la aplicación 
session_start();

// CAPA DE ACCESO A DATOS: Conexión a la base de datos 
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    /**
     * Empleamos métodos para recuperar la información 
     * introducida en el formulario.
     */
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    /**
     * Creamos aplicaciones que establezcan conexiones con BD.
     * Buscamos al usuario por su correo electrónico.
     */
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $user = mysqli_fetch_assoc($res);
        
        // Verificamos si la contraseña coincide con el hash guardado
        if (password_verify($password, $user['password'])) {
            
            // Guardamos los datos en la sesión para mantener el estado 
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];
            
            // Redirigimos a la página principal tras el éxito
            header("Location: ../index.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../login.php?error=credenciales");
            exit();
        }
    } else {
        // El usuario no existe
        header("Location: ../login.php?error=no_existe");
        exit();
    }
}

// Cerramos la conexión para optimizar recursos
mysqli_close($conn);
?>