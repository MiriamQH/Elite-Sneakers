// Validaciones de la Capa Cliente para Elite Sneakers
document.addEventListener("DOMContentLoaded", function() {

    // 1. Validación para el Registro y Edición de Usuarios 
    const formUsuario = document.querySelector('form[action*="registro.php"], form[action*="usuario_form.php"]');
    if (formUsuario) {
        formUsuario.addEventListener("submit", function(e) {
            let nombre = document.querySelector('input[name="nombre"]').value;
            let email = document.querySelector('input[type="email"]').value;
            
            if (nombre.trim() === "") {
                alert("El nombre es obligatorio");
                e.preventDefault(); // Detiene el envío del formulario
                return;
            }

            // Validar formato de email sencillo
            let emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailReg.test(email)) {
                alert("El formato del email no es válido");
                e.preventDefault();
            }
        });
    }

    // 2. Validación para el Formulario de Productos 
    const formProducto = document.querySelector('form[action*="producto_form.php"]');
    if (formProducto) {
        formProducto.addEventListener("submit", function(e) {
            let precio = parseFloat(document.querySelector('input[name="precio"]').value);
            let stock = parseInt(document.querySelector('input[name="stock"]').value);

            if (isNaN(precio) || precio <= 0) {
                alert("El precio debe ser un número mayor que 0");
                e.preventDefault();
            }

            if (isNaN(stock) || stock < 0) {
                alert("El stock no puede ser negativo");
                e.preventDefault();
            }
        });
    }
});