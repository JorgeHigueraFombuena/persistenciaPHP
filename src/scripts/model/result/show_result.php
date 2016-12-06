<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function get_result($idResult){
    $entityManager = getEntityManager();

    $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');

    /** @var \MiW16\Results\Entity\Result $result */
    $result = $resultRepository->findOneById($idResult);
    return $result;

}

if(php_sapi_name() === 'cli') {
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
}