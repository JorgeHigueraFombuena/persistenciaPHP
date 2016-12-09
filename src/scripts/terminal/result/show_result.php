<?php
require_once __DIR__ . '/../../web/model/result_functions.php';


if ($argc < 2) {
    echo "$argv[0] <id_result>" . PHP_EOL;
    exit();
}
/** @var \MiW16\Results\Entity\Result $result */
$result = get_result($argv[1]);

if ($result) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo 'Usuario no encontrado';
}
