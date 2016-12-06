<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function delete_result($idResult)
{
    $entityManager = getEntityManager();

    $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');

    /** @var \MiW16\Results\Entity\Result $result */
    $result = $resultRepository->findOneById($idResult);
    if ($result) {
        $entityManager->remove($result);
        $entityManager->flush();
        return true;
    } else {
        return false;
    }
}

if (php_sapi_name() === 'cli') {

    if ($argc < 2) {
        echo "$argv[0] <id_result>" . PHP_EOL;
        exit();
    }
    $result = delete_result($argv[1]);
    if (!$result) {
        echo 'Resultado no encontrado';
    }
}