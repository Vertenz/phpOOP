<?php


namespace app\controllers;


use app\entities\Cart;
use app\services\Session;

class CartController extends MainController
{

    public function allAction()
    {
        $arr = $this->container->session->get('cart'); //Session::get('cart');
        $carts = new Cart();
        foreach ($arr as $key => $value) {
            $carts->id = $key;
            $carts->qty = $value;
            echo $this->renderer->render('cartAll', ['carts' => $carts]);
        }
    }


    public function addAction()
    {
        $productId = $this->request->post('id');
        $productQty = $this->request->post('qty');
        $arr = $this->container->session->get('cart'); //Session::get('cart');
       $this->container->session->push($arr, $productId, $productQty);
        return $this->request->redirect('/product/'); //header('Location: /product/');
    }

    public function delAction()
    {
        $deleteId = $this->request->post('id');
        $res = $this->container->session->get('cart', $deleteId); //Session::get('cart', $deleteId);
        $this->container->session->delete('cart', $deleteId);// Session::delete($res, $deleteId);
        $this->request->redirect('/cart/'); //header("Location: /cart/");
    }


}