<?php
require_once __DIR__ . '/../../../../bootstrap.php';

require_once __DIR__ . '/../model/user_functions.php';
require_once __DIR__ . '/../model/result_functions.php';

class UsersController
{
    public function init()
    {
        $users = list_users();
        $results = get_all_results();
        require __DIR__ . '/../views/list_users.php';
    }

    public function createUser($username = null, $email = null, $password = null)
    {
        if ($username !== null) {
            $res = create_user($username, $email, $password);

            if ($res) {
                $returnLink = '/';
                $message = 'Se ha creado correctamente';
            } else {
                $returnLink = '/create_user';
                $message = 'ERROR! Ha ocurrido un error inesperado al intentar crear el usuario';
            }
            require __DIR__ . '/../views/message.php';
        } else {
            require __DIR__ . '/../views/create_user.php';
        }
    }

    public function deleteUser($idUser)
    {
        $results = get_all_results();
        $resultsOfUser = array();
        /** @var \MiW16\Results\Entity\Result $result */
        foreach ($results as $result) {
            if ($result->getUser()->getId() === $idUser) {
                array_push($resultsOfUser, $result);
            }
        }
        $returnLink = '/';
        if (count($resultsOfUser) == 0) {
            $res = delete_user($idUser);
            $message = '';
            if ($res) {
                $message = 'Se ha borrado el usuario correctamente';
            } else {
                $message = 'ERROR! Se ha producido un error al borrar al usuario';
            }
        } else {
            $message = 'ERROR! El usuario tiene resultados, debes borrar antes sus resultados';
        }
        require __DIR__ . '/../views/message.php';
    }

    public function updateUser($idUser, $username = null, $email = null, $password = null)
    {
        $user = get_user($idUser);
        $returnLink = '/';
        if ($user) {
            if ($username) {
                $res = update_user($idUser, $username, $email, $password);
                if ($res) {
                    $returnLink = '/';
                    $message = 'Se ha actualizado correctamente';
                } else {
                    $returnLink = '/update_user/' . $idUser;
                    $message = 'ERROR! Ha ocurrido un error inesperado al intentar actualizar el usuario';
                }
                require __DIR__ . '/../views/message.php';
            } else {
                require __DIR__ . '/../views/create_user.php';
            }
        } else {
            $message = 'ERROR! El usuario no existe';
            require __DIR__ . '/../views/message.php';
        }
    }
}