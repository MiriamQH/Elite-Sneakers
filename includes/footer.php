<footer class="footer-elite">
    <div class="footer-container">
        <div class="footer-column">
            <div class="texto-logo">ELITE <span>SNEAKERS</span></div>
            <p class="footer-description">
                La plataforma definitiva para coleccionistas. Calzado exclusivo y lanzamientos limitados con envío garantizado a toda la península.
            </p>
            <div class="footer-social">
                <span>📱 @EliteSneakers_ES</span>
            </div>
        </div>

        <div class="footer-column">
            <h3>Navegación</h3>
            <ul>
                <li><a href="index.php">Catálogo Completo</a></li>
                <li><a href="carrito.php">Mi Cesta</a></li>
                <li><a href="login.php">Mi Cuenta</a></li>
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <li><a href="admin/index.php" style="color: var(--rojo);">Panel de Control</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Soporte</h3>
            <ul>
                <li>📍 Sanlúcar de Barrameda, Cádiz</li>
                <li>📧 soporte@elitesneakers.com</li>
                <li>🚚 Envío Gratis en pedidos +99€</li>
                <li>🔒 Pago 100% Seguro</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Elite Sneakers Project - Módulo DAW Servidor. Todos los derechos reservados.</p>
    </div>
</footer>