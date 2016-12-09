<?php
require_once __DIR__ . '/../../web/model/result_functions.php';

if ($argc < 2) {
    echo "$argv[0] <id_user> <id_result> <result> <date>" . PHP_EOL;
    exit();
}
if (!DateTime::createFromFormat('Y-m-d', $argv[4])) {
    echo "Introduce un formato de fecha válido. Ejemplo: 1999-12-30";
    exit();
}

$result = update_result($argv[2], $argv[1], $argv[3], $argv[4]);
if (!$result) {
    echo 'Ha ocurrido un problema al intentar actualizar al resultado';
}
