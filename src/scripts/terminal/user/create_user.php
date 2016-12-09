<?php

require_once __DIR__ . '/../../web/model/user_functions.php';


if ($argc < 3) {
    echo "$argv[0] <nombre_usuario> <email> <password>" . PHP_EOL;
    exit();
}

create_user($argv[1], $argv[2], $argv[3]);
