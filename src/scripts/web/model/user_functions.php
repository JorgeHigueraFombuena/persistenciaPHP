<?php
require_once __DIR__ . '/../../../bootstrap.php';

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

function list_users(){
    $entityManager = getEntityManager();

    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');
    $users = $userRepository->findAll();
    return $users;
}

function get_user($idUser){
    $entityManager = getEntityManager();

    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');

    /** @var \MiW16\Results\Entity\User $user */
    $user = $userRepository->findOneById($idUser);
    return $user;
}

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