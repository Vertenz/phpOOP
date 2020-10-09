<?php
namespace app\models;
class Users extends Model
{
    public $id;    public $login;
    public $password;


    /**
     * Метод для
     *
     * @return mixed
     */
    protected static function getTableName():string
    {
        return 'users';
    }
}
