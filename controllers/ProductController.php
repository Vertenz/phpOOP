<?php


namespace app\controllers;


use app\repositories\ProductRepository;

class ProductController extends MainController
{
    public function allAction()
    {
        $goods = $this->container->productRepository->getAll();
        return $this->renderer->render('productAll', ['goods' => $goods]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = $this->container->productRepository->getOne($id);
        return $this->renderer->render('productOne', ['good' => $good]);
    }

    public function addAction()
    {
        return $this->renderer->render('productAdd');
    }

    public function pushAction()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->request->post('name'); //$_POST['name'];
            $price = $this->request->post('price');;
            $description = $this->request->post('description');
            $type = $this->request->post('type');
            $quantity = $this->request->post('quantity');


            $product = new \app\entities\Product();
            $product->name = $name;
            $product->price = $price;
            $product->descriptions = $description;
            $product->type = $type;
            $product->quantity = $quantity;
            $product->img = 'href';
            if (!$res = $this->container->productRepository->save($product)) {
                return "<h1>Insert ERROR in pushAction</h1>";
            } else {
                echo "<script>
                               document.getElementById('status').
                               insertAdjacentHTML('beforeend', 'товар добавлен');
                          </script>";
            }
            return $this->request->redirect('/product/add/'); //header("Location: /product/add/");
        } else echo "error";
    }
}