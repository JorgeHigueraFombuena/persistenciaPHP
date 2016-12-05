<?php
require_once __DIR__ . '/../../../bootstrap.php';


if ($argc < 2) {
    echo "$argv[0] <id_result>" . PHP_EOL;
    exit();
}

$entityManager = getEntityManager();

$resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');

/** @var \MiW16\Results\Entity\Result $result */
$result = $resultRepository->findOneById($argv[1]);

if($result) {
    echo json_encode($result, JSON_PRETTY_PRINT);
}
else {
    echo 'Usuario no encontrado';
}