<?php
require_once __DIR__ . '/../../../bootstrap.php';


if ($argc < 2) {
    echo "$argv[0] <id_user> <user_name> <email> <password>" . PHP_EOL;
    exit();
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

/** @var \MiW16\Results\Entity\User $user */
$user = $userRepository->findOneById($argv[1]);
if($user) {
    $user->setUsername($argv[2]);
    $user->setEmail($argv[3]);
    $user->setPassword($argv[4]);
    $entityManager->persist($user);
    $entityManager->flush();
    echo 'Actualización correcta!';
}
else {
    echo 'Usuario no encontrado';
}