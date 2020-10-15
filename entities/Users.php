<?php


namespace app\entities;


class Users extends Entity
{
    public $id;
    public $login;
    public $password;
    public $type;
}