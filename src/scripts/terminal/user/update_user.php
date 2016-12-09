<?php
require_once __DIR__ . '/../../web/model/user_functions.php';

if ($argc < 2) {
    echo "$argv[0] <id_user> <user_name> <email> <password>" . PHP_EOL;
    exit();
}

$result = update_user($argv[1], $argv[2], $argv[3], $argv[4]);
if ($result) {
    echo 'Actualización correcta!';
} else {
    echo 'ERROR! No se ha actualizado';
}
