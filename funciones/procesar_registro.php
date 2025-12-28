<?php
/**
 * CAPA DE LÓGICA DE NEGOCIO (PHP) 
 * Este archivo gestiona el registro de nuevos clientes.
 */

//  Iniciamos la sesión para controlar el estado de la aplicación 
session_start();

// CAPA DE ACCESO A DATOS: Importamos la conexión centralizada 
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    /**
     * Recuperación de la información del formulario 
     * Validamos que los campos obligatorios definidos por el alumno no estén vacíos 
     */
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['password'])) {
        header("Location: ../registro.php?error=campos_vacios");
        exit();
    }

    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    // Aplicamos seguridad en la contraseña antes de guardarla
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    /**
     * Conexión y ejecución en Base de Datos 
     * Empleamos Prepared Statements para evitar inyecciones SQL y asegurar la funcionalidad.
     * Por defecto, los registros nuevos tienen el rol 'cliente'.
     */
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')";
    
    if ($stmt = $conn->prepare($sql)) {
        // Vinculamos los parámetros (s = string)
        $stmt->bind_param("sss", $nombre, $email, $password);
        
        if ($stmt->execute()) {
            /**
             * ÉXITO: Redirigimos al Login enviando un parámetro por URL (GET)
             * para mostrar el mensaje de confirmación que configuramos en el CSS.
             */
            header("Location: ../login.php?registro=exito");
            exit();
        } else {
            // Manejo de errores (ej. email duplicado)
            echo "Error en la ejecución: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Cerramos la conexión al finalizar para optimizar recursos
$conn->close();
?>