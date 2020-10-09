<?php


namespace app\controllers;

use app\entities\Users;
use app\repositories\UsersRepository;

class UsersController extends MainController
{

    public function allAction()
    {
        $users = (new UsersRepository())->getAll();
        return $this->renderer->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = (new UsersRepository())->getOne($id);
        return $this->renderer->render('userOne', ['user' => $person,
            'title' => $person->login]);
    }

    public function addAction()
    {
        return $this->renderer->render('userAdd');
    }

    public function pushAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = new Users();
            $user->password = $password;
            $user->login = $login;
            if (!$res = (new UsersRepository())->save($user)) {
                return "<h1>Insert ERROR in pushAction</h1>";
            } else {
                echo "<h1>Insert ok</h1>>";
            }
            header("Location: /users/add/");
        } else echo "error";
    }


}