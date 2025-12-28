<nav class="header-elite">
    <div class="bloque-nav nav-izq">
        <a href="index.php" class="enlace-logo">
            <svg class="icono-svg" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M495.7 342.3l-50.6-104.1c-15.6-32.1-48.4-52.4-84.1-52.4H304c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h57c17.9 0 34.3 10.1 42.1 26.2l31.7 65.3c3.6 7.4 1.2 16.5-5.6 21l-34.9 23.3c-2.4 1.6-5.2 2.4-8 2.4H160c-26.5 0-48-21.5-48-48V160c0-26.5 21.5-48 48-48h96c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H160C71.6 64 0 135.6 0 224v192c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32v-31.5c0-16.7-6.5-32.7-18.3-44.2z"/>
            </svg>
            <div class="texto-logo">ELITE <span>SNEAKERS</span></div>
        </a>
    </div>

    <div class="bloque-nav nav-centro">
        <a href="index.php">Catálogo</a>

        <?php if(isset($_SESSION['usuario_id']) && $_SESSION['rol'] != 'admin'): ?>
            <a href="perfil.php" style="font-weight: 700;">Mi Perfil</a>
            <a href="mis_pedidos.php" style="font-weight: 700;">Mis Pedidos</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
            <a href="admin/index.php" style="color: #f1c40f; font-weight: 900;">Panel Admin</a>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['usuario_id'])): ?>
            <a href="logout.php" style="color: var(--rojo);">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar Sesión</a>
            <a href="registro.php">Regístrate</a>
        <?php endif; ?>
    </div>

    <div class="bloque-nav nav-der">
        <a href="carrito.php" class="boton-carrito">🛒 MI CARRITO</a>
    </div>
</nav>