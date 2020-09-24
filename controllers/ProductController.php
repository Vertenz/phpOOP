<?php


namespace app\controllers;


use app\models\Product;

class ProductController extends MainController
{
    public function allAction()
    {
        $goods = Product::getAll();
        return $this->render('productAll', ['goods' => $goods]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = Product::getOne($id);
        return $this->render('productOne', ['good' => $good]);
    }
}