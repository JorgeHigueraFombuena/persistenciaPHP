<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function create_result($idUser, $resultValue, $dateString)
{
    try {
        $entityManager = getEntityManager();

        $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

        /** @var \MiW16\Results\Entity\User $user */
        $user = $userRepository->findOneById($idUser);
        if ($user) {
            /** @var \MiW16\Results\Entity\Result $result */
            $date = DateTime::createFromFormat('Y-m-d', $dateString);
            $result = new \MiW16\Results\Entity\Result($resultValue, $user, $date);

            $entityManager->persist($result);
            $entityManager->flush();
            return true;
        } else {
            return false;
        }
    } catch (Exception $exception) {
        return false;
    }
}

if (php_sapi_name() === 'cli') {

    if ($argc < 4) {
        echo "$argv[0] <id_user> <result> <date>" . PHP_EOL;
        exit();
    }
    if (!DateTime::createFromFormat('Y-m-d', $argv[3])) {
        echo "Introduce un formato de fecha válido. Ejemplo: 1999-12-30";
        exit();
    }

    $res = create_result($argv[1], intval($argv[2]), $argv[3]);
    if (!$res) {
        echo 'Ha ocurrido un error al intentar crear el resultado';
    }

}