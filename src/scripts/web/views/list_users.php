<?php
$title = 'Lista de usuarios';

ob_start();
?>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Enabled</th>
        <th>Results</th>
    </tr>
    <?php
    /** @var \MiW16\Results\Entity\User $user */
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user->getId() . '</td>';
        echo '<td>' . $user->getUsername() . '</td>';
        echo '<td>' . $user->getEmail() . '</td>';
        echo '<td>' . $user->isEnabled() . '</td>';
        echo '<td>';
        $found = false;
        /** @var \MiW16\Results\Entity\Result $result */
        foreach ($results as $result) {
            if($result->getUser()->getId() === $user->getId()){
                $found = true;
                echo '<a href="show_results/' . $user->getId() . '">Mostrar resultados</a>';
                break;
            }
        }
        if(!$found){
            echo '<a href="create_result/' . $user->getId() . '">Crear resultado</a>';
        }
        echo '</td>';
        echo '<td><a href="delete_user/' . $user->getId() . '" >Eliminar usuario</a></td>';
        echo '<td><a href="update_user/' . $user->getId() . '" >Actualizar usuario</a></td>';
        echo '</tr>';
        echo '<p><a href="/create_user">Crear usuario</a></p>';
        echo '<p><a href="/show_results">Mostrar todos los resultados</a></p>';
    }
    ?>
</table>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';