<?php
require_once __DIR__ . '/../../../bootstrap.php';


if ($argc < 3) {
    echo "$argv[0] <nombre_usuario> <email> <password>" . PHP_EOL;
    exit();
}

$entityManager = getEntityManager();

/** @var \MiW16\Results\Entity\User $user */
$user = new \MiW16\Results\Entity\User();
$user->setUsername($argv[1]);
$user->setEmail($argv[2]);
$user->setPassword($argv[3]);

$entityManager->persist($user);
$entityManager->flush();
