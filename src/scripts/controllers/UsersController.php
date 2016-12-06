<?php
require_once __DIR__ . '/../../../bootstrap.php';

require __DIR__ . '/../model/user/list_users.php';
require __DIR__ . '/../model/user/delete_user.php';
require __DIR__ . '/../model/user/create_user.php';
require __DIR__ . '/../model/result/list_results.php';

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

            if($res){
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
            echo var_dump($res);
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
}