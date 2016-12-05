<?php
require_once __DIR__ . '/../../bootstrap.php';


if ($argc < 2) {
    echo "$argv[0] <id_user>" . PHP_EOL;
    exit();
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

/** @var \MiW16\Results\Entity\User $user */
$user = $userRepository->findOneById($argv[1]);

if($user) {
    $entityManager->remove($user);
    $entityManager->flush();
}
else {
    echo 'Usuario no encontrado';
}