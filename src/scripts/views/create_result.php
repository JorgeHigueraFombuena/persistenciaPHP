<?php
$title = 'Crear resultado';
$idResult = null;
$idUser = null;
$resultValue = null;
$date = null;
if ($result) {
    $idResult = $result->getId();
    $idUser = $result->getUser()->getId();
    $resultValue = $result->getResult();
    $date = $result->getTime();
}

ob_start();
?>
    <form onsubmit="/create_result" method="get">
        <select name="iduser">
            <?php
            /** @var \MiW16\Results\Entity\User $user */
            foreach ($users as $user) {
                echo '<option value="' . $user->getId() . '"';
                if ($idUser === $user->getId()) {
                    echo 'selected="selected"';
                }
                echo '>' . $user->getUsername() . '</option>';
            }
            ?>
        </select>
        <input type="number" name="result" value="<?php if ($resultValue) echo $resultValue; ?>" required>
        <input type="date" name="date" placeholder="1999-12-30"
               value="<?php if ($date) echo $date->format('Y-m-d'); ?>" required>
        <input type="hidden" name="idResult" value="<?php if ($idResult) echo $idResult; ?>">
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';