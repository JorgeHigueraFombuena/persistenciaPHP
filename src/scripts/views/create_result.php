<?php
$title = 'Crear resultado';

ob_start();
?>
    <form onsubmit="/create_result" method="get">
        <select name="iduser">
            <?php
            /** @var \MiW16\Results\Entity\User $user */
            foreach ($users as $user) {
                echo '<option value="' . $user->getId() . '">' . $user->getUsername() . '</option>';
}
            ?>
        </select>
        <input type="number" name="result" required>
        <input type="date" name="date" placeholder="dd/MM/yyyy">
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';