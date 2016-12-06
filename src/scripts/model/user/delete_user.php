<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function delete_user($idUser){
    $entityManager = getEntityManager();

    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

    /** @var \MiW16\Results\Entity\User $user */
    $user = $userRepository->findOneById($idUser);
    if ($user) {
        try {
            $entityManager->remove($user);
            $entityManager->flush();
        } catch (Exception $exception){
            return false;
        }
        return true;
    } else {
        return false;
    }
}

if(php_sapi_name() === 'cli') {
    if ($argc < 2) {
        echo "$argv[0] <id_user>" . PHP_EOL;
        exit();
    }

    $res = delete_user($argv[1]);
    if(!$res){
        echo 'Ha ocurrido un problema al intentar borrar al usuario';
    }
}