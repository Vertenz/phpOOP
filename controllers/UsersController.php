<?php


namespace app\controllers;

use app\entities\Users;
use app\repositories\UsersRepository;

class UsersController extends MainController
{

    public function allAction()
    {
        $users = $this->container->usersRepository->getAll();
        return $this->renderer->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = $this->container->usersRepository->getOne($id);
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
            $login = $this->request->post('login');
            $password = $this->request->post('password');
            $user = new Users();
            $user->password = $password;
            $user->login = $login;
            if (!$res = $this->container->users->save($user)) {
                return "<h1>Insert ERROR in pushAction</h1>";
            } else {
                echo "<h1>Insert ok</h1>>";
            }
            $this->request->redirect('/users/add/');//header("Location: /users/add/");
        } else echo "error";
    }

    protected function getHash($string)
    {
        return md5($string . "d5f8");
    }


}