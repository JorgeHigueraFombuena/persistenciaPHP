<?php
$title = 'Crear resultado';
$idResult = null;
$resultValue = null;
$date = null;
if (isset($result)) {
    $idResult = $result->getId();
    $idUser = $result->getUser()->getId();
    $resultValue = $result->getResult();
    $date = $result->getTime();
}

ob_start();
?>
    <form onsubmit="/create_result" method="get">
        <label for="iduser">Usuario: </label>
        <select name="iduser">
            <?php
            if(isset($users)) {
                /** @var \MiW16\Results\Entity\User $user */
                foreach ($users as $user) {
                    echo '<option value="' . $user->getId() . '"';
                    if ($idUser === $user->getId()) {
                        echo 'selected="selected"';
                    }
                    echo '>' . $user->getUsername() . '</option>';
                }
            }
            else{
                echo '<option value="' . $user->getId() . '"';
                echo '>' . $user->getUsername() . '</option>';
            }
            ?>
        </select>
        <label for="result">Resultado: </label>
        <input type="number" name="result" value="<?php if ($resultValue) echo $resultValue; ?>" required>
        <label for="date">Fecha (YYYY-MM-DD): </label>
        <input type="text" name="date" placeholder="1999-12-30"
               value="<?php if ($date) echo $date->format('Y-m-d'); ?>" pattern="\d{4}-\d{2}-\d{2}" required>
        <input type="hidden" name="idResult" value="<?php if ($idResult) echo $idResult; ?>">
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';