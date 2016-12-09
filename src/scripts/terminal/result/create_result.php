<?php
require_once __DIR__ . '/../../web/model/result_functions.php';


if ($argc < 4) {
    echo "$argv[0] <id_user> <result> <date>" . PHP_EOL;
    exit();
}
if (!DateTime::createFromFormat('Y-m-d', $argv[3])) {
    echo "Introduce un formato de fecha válido. Ejemplo: 1999-12-30";
    exit();
}

$res = create_result($argv[1], intval($argv[2]), $argv[3]);
if (!$res) {
    echo 'Ha ocurrido un error al intentar crear el resultado';
}
