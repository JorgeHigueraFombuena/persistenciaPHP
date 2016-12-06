<?php
$title = 'Lista de resultados';

ob_start();
?>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Resultado</th>
            <th>Fecha</th>
        </tr>
        <?php
        /** @var \MiW16\Results\Entity\Result $result */
        foreach ($resultsOfUser as $result) {
            echo '<tr>';
            echo '<td>' . $result->getId() . '</td>';
            echo '<td>' . $result->getUser()->getUsername() . '</td>';
            echo '<td>' . $result->getResult() . '</td>';
            echo '<td>' . $result->getTime()->format('Y-m-d H:i:s') . '</td>';
            echo '<td><a href="/delete_result/' . $result->getId() . '" >Eliminar resultado</a>';
            echo '<td><a href="/update_result/' . $result->getId() . '" >Actualizar resultado</a>';
            echo '</tr>';
            echo '<p><a href="/create_result">Crear resultado</a></p>';
            echo '<p><a href="/">Volver</a></p>';
        }
        ?>
    </table>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';