<?php
require_once __DIR__ . '/../../web/model/user_functions.php';


if ($argc < 2) {
    echo "$argv[0] <id_user>" . PHP_EOL;
    exit();
}

$user = get_user($argv[1]);

if ($user) {
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {
    echo 'Usuario no encontrado';
}
