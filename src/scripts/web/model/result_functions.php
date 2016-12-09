<?php
require_once __DIR__ . '/../../../bootstrap.php';

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

function get_all_results(){
    $entityManager = getEntityManager();

    $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');
    $results = $resultRepository->findAll();
    return $results;
}


function get_result($idResult){
    $entityManager = getEntityManager();

    $resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');

    /** @var \MiW16\Results\Entity\Result $result */
    $result = $resultRepository->findOneById($idResult);
    return $result;

}

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