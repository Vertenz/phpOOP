<?php
namespace app\models;
class Product extends Model
{

    public $id = 159;
    public $name = 'sto';
    public $price = 1;
    public $descriptions = '1';
    public $type = '1';
    public $view = 1;
    public $quantity = 1;
    /**
     * Метод для
     *
     * @return mixed
     */
    protected function getTableName():string
    {
        return 'product';
    }

}
