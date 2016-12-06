<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function update_result($idResult, $idUser, $resultValue, $dateString)
{
    try {
        $entityManager = getEntityManager();

        $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

        /** @var \MiW16\Results\Entity\User $user */
        $user = $userRepository->findOneById($idUser);
        if ($user) {
            $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');
            /** @var \MiW16\Results\Entity\Result $result */
            $result = $resultRepository->findOneById($idResult);
            if ($result) {
                $date = DateTime::createFromFormat('Y-m-d', $dateString);
                $result->setResult($resultValue);
                $result->setTime($date);
                $result->setUser($user);
                $entityManager->persist($result);
                $entityManager->flush();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $exception) {
        return false;
    }
}

if (php_sapi_name() === 'cli') {
    if ($argc < 2) {
        echo "$argv[0] <id_user> <id_result> <result> <date>" . PHP_EOL;
        exit();
    }
    if (!DateTime::createFromFormat('Y-m-d', $argv[4])) {
        echo "Introduce un formato de fecha válido. Ejemplo: 1999-12-30";
        exit();
    }

    $result = update_result($argv[2], $argv[1], $argv[3], $argv[4]);
    if (!$result) {
        echo 'Ha ocurrido un problema al intentar actualizar al resultado';
    }
}