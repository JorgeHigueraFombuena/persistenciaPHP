<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function get_user($idUser){
    $entityManager = getEntityManager();

    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

    /** @var \MiW16\Results\Entity\User $user */
    $user = $userRepository->findOneById($idUser);
    return $user;
}

if(php_sapi_name() === 'cli') {
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
}