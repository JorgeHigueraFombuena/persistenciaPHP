<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function update_user($idUser, $username, $email, $password)
{
    try {
        $entityManager = getEntityManager();

        $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

        /** @var \MiW16\Results\Entity\User $user */
        $user = $userRepository->findOneById($idUser);
        if ($user) {
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            $entityManager->persist($user);
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
    if ($argc < 2) {
        echo "$argv[0] <id_user> <user_name> <email> <password>" . PHP_EOL;
        exit();
    }

    $result = update_user($argv[1], $argv[2], $argv[3], $argv[4]);
    if ($result) {
        echo 'Actualización correcta!';
    } else {
        echo 'ERROR! No se ha actualizado';
    }
}