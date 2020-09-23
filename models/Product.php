<?php
namespace app\models;
class Product extends Model
{

    public $id;
    public $name;
    public $price;
    public $descriptions;
    public $type;
    public $view;
    public $quantity;
    /**
     * Метод для
     *
     * @return mixed
     */
    protected static function getTableName():string
    {
        return 'product';
    }

}
