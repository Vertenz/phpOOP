<?php


namespace app\repositories;


use app\entities\Cart;
use app\services\Session;

class CartRepository extends Repository
{

    protected function getTableName(): string
    {
        return 'cart';
    }

    protected function getEntityName(): string
    {
        return Cart::class;
    }
}