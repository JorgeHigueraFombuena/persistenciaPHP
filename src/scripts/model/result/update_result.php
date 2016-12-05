<?php
require_once __DIR__ . '/../../../../bootstrap.php';


if ($argc < 2) {
    echo "$argv[0] <id_user> <id_result> <result> <date>" . PHP_EOL;
    exit();
}
if(!DateTime::createFromFormat('d/m/Y', $argv[4])){
    echo "Introduce un formato de fecha válido. Ejemplo: 01/02/1999";
    exit();
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

/** @var \MiW16\Results\Entity\User $user */
$user = $userRepository->findOneById($argv[1]);
if($user) {
    $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');
    /** @var \MiW16\Results\Entity\Result $result */
    $result = $resultRepository->findOneById($argv[2]);
    if($result) {
        $date = DateTime::createFromFormat('d/m/Y', $argv[4]);
        $result->setResult($argv[3]);
        $result->setTime($date);
        $entityManager->persist($result);
        $entityManager->flush();
        echo 'Actualización correcta!';
    }
    else{
        echo 'Resultado no encontrado';
    }
}
else {
    echo 'Usuario no encontrado';
}