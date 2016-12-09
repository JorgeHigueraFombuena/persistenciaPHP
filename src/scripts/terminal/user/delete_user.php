<?php
require_once __DIR__ . '/../../web/model/user_functions.php';


if ($argc < 2) {
    echo "$argv[0] <id_user>" . PHP_EOL;
    exit();
}

$res = delete_user($argv[1]);
if (!$res) {
    echo 'Ha ocurrido un problema al intentar borrar al usuario';
}
