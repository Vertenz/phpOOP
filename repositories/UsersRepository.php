<?php


namespace app\repositories;


use app\entities\Users;

class UsersRepository extends Repository
{

    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityName(): string
    {
        return Users::class;
    }

}