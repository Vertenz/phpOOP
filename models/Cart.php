<?php
namespace app\models;


class Cart extends Model
{
    protected $id;
    protected $customer;
    protected $cost;
    protected $status;


    protected function getTableName(): string
    {
        return 'cart';
    }
}