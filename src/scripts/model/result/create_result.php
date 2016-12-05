<?php
require_once __DIR__ . '/../../../bootstrap.php';


if ($argc < 4) {
    echo "$argv[0] <id_user> <result> <date>" . PHP_EOL;
    exit();
}
if(!DateTime::createFromFormat('d/m/Y', $argv[3])){
    echo "Introduce un formato de fecha válido. Ejemplo: 01/02/1999";
    exit();
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

/** @var \MiW16\Results\Entity\User $user */
$user = $userRepository->findOneById($argv[1]);
if($user) {
    /** @var \MiW16\Results\Entity\Result $result */
    $date = DateTime::createFromFormat('d/m/Y', $argv[3]);
    $result = new \MiW16\Results\Entity\Result(intval($argv[2]), $user, $date);

    $entityManager->persist($result);
    $entityManager->flush();
}
else {
    echo 'Usuario no encontrado';
}