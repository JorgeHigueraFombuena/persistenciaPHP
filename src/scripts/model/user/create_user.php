<?php
require_once __DIR__ . '/../../../../bootstrap.php';

function create_user($username, $email, $password)
{
    try {
        $entityManager = getEntityManager();

        /** @var \MiW16\Results\Entity\User $user */
        $user = new \MiW16\Results\Entity\User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        $entityManager->persist($user);
        $entityManager->flush();
    } catch (Exception $exception) {
        return false;
    }
    return true;
}

if (php_sapi_name() === 'cli') {
    if ($argc < 3) {
        echo "$argv[0] <nombre_usuario> <email> <password>" . PHP_EOL;
        exit();
    }

    create_user($argv[1], $argv[2], $argv[3]);
}