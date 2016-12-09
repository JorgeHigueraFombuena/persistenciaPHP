<?php
require_once __DIR__ . '/../../../../bootstrap.php';

require_once __DIR__ . '/../model/result_functions.php';


class ResultsController
{
    public function initResultList($idUser = null)
    {
        $results = get_all_results();
        $resultsOfUser = array();
        if ($idUser !== null) {
            /** @var \MiW16\Results\Entity\Result $result */
            foreach ($results as $result) {
                if ($result->getUser()->getId() === $idUser) {
                    array_push($resultsOfUser, $result);
                }
            }
        } else {
            $resultsOfUser = $results;
        }
        require __DIR__ . '/../views/list_results.php';
    }

    public function initResultListOfUser($idUser)
    {
        $this->initResultList($idUser);
    }

    public function createResult($idUser = null, $resultValue = null, $dateString = null)
    {
        if ($idUser !== null) {
            if($resultValue !== null) {
                $res = create_result($idUser, $resultValue, $dateString);

                $returnLink = '/show_results/' . $idUser;
                if ($res) {
                    $message = 'Se ha creado correctamente';
                } else {
                    $message = 'ERROR! Ha ocurrido un error inesperado al intentar crear el resultado';
                }
                require __DIR__ . '/../views/message.php';
            } else {
                $user = get_user($idUser);
                require __DIR__ . '/../views/create_result.php';
            }
        } else {
            $users = list_users();
            require __DIR__ . '/../views/create_result.php';
        }
    }

    public function deleteResult($idResult)
    {
        $res = delete_result($idResult);
        $returnLink = '/show_results';
        if ($res) {
            $message = 'Se ha borrado correctamente';
        } else {
            $message = 'ERROR! Ha ocurrido un error inesperado al intentar borrar el resultado';
        }
        require __DIR__ . '/../views/message.php';
    }

    public function updateResult($idResult, $idUser = null, $resultValue = null, $dateString = null)
    {
        $result = get_result($idResult);
        $returnLink = '/';
        if ($result) {
            if ($idUser) {
                $res = update_result($idResult, $idUser, $resultValue, $dateString);
                if ($res) {
                    $returnLink = '/show_results/' . $idUser;
                    $message = 'Se ha actualizado correctamente';
                } else {
                    $returnLink = '/update_result/' . $idResult;
                    $message = 'ERROR! Ha ocurrido un error inesperado al intentar actualizar el resultado';
                }
                require __DIR__ . '/../views/message.php';
            } else {
                $users = list_users();
                require __DIR__ . '/../views/create_result.php';
            }
        } else {
            $message = 'ERROR! El resultado no existe';
            require __DIR__ . '/../views/message.php';
        }
    }
}