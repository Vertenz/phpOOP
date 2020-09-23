<?php


namespace app\controllers;

use app\models\Users;

class UsersController extends MainController
{
    public function allAction()
    {
        $users = Users::getAll();
        return $this->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = Users::getOne($id);
        return $this->render('userOne', ['user' => $person]);
    }

    public function updateAction()
    {
        /** @var Users $user */
        $user = Users::getOne(40);
        $user->login = 'Admin12';
        $user->save();
    }


}