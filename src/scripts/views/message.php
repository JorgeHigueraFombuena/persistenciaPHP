<?php
$title = 'Lista de usuarios';

ob_start();
?>
    <p style="color: red; font-size: large;"><?php echo $message ?></p>
    <p><a href="<?php echo $returnLink ?>">Volver</a></p>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';