<?php


namespace app\controllers;


use app\repositories\ProductRepository;

class ProductController extends MainController
{
    public function allAction()
    {
        $goods = (new ProductRepository())->getAll();
        return $this->renderer->render('productAll', ['goods' => $goods]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = (new ProductRepository())->getOne($id);
        return $this->renderer->render('productOne', ['good' => $good]);
    }

    public function addAction()
    {
        return $this->renderer->render('productAdd');
    }

    public function pushAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $type = $_POST['type'];
            $quantity = $_POST['quantity'];


            $product = new \app\entities\Product();
            $product->name = $name;
            $product->price = $price;
            $product->descriptions = $description;
            $product->type = $type;
            $product->quantity = $quantity;
            $product->img = 'href';
            if (!$res = (new ProductRepository())->save($product)) {
                return "<h1>Insert ERROR in pushAction</h1>";
            } else {
                echo "<script>
                               document.getElementById('status').
                               insertAdjacentHTML('beforeend', 'товар добавлен');
                          </script>";
            }
            header("Location: /product/add/");
        } else echo "error";
    }
}