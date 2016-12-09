<?php
require_once __DIR__ . '/../../web/model/result_functions.php';

if ($argc < 2) {
    echo "$argv[0] <id_result>" . PHP_EOL;
    exit();
}
$result = delete_result($argv[1]);
if (!$result) {
    echo 'Resultado no encontrado';
}
