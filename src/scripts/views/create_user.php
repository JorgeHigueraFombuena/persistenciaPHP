<?php
$title = 'Crear usuario';

ob_start();
?>
    <form onsubmit="/create_user" method="get">
        <input type="text" name="username" required>
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <input type="submit" name="enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';