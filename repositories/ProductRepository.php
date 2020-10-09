<?php


namespace app\repositories;


use app\entities\Product;

class ProductRepository extends Repository
{

    protected function getTableName(): string
    {
        return 'product';
    }

    protected function getEntityName(): string
    {
        return Product::class;
    }
}