<?php


namespace app\controllers;


use app\entities\Cart;
use app\services\Session;

class CartController extends MainController
{

    public function allAction()
    {
        $arr = Session::get('cart');
        $carts = new Cart();
        foreach ($arr as $key => $value) {
            $carts->id = $key;
            $carts->qty = $value;
            echo $this->renderer->render('cartAll', ['carts' => $carts]);
        }
//        return $this->renderer->render('cartAll', ['carts' => $carts]);
//        foreach ($ids as $key => $qty) {
//            $arr[] = $key;
//            foreach ($arr as $id) {
//                $cart = (new ProductRepository())->getOne($id);
//                var_dump($cart);
//            }
//        }

    }


    public function addAction()
    {
        $productId = $this->request->post('id');
        $productQty = $this->request->post('qty');
        $arr = Session::get('cart');
        Session::push($arr, $productId, $productQty);
        return header('Location: /product/');
    }

    public function delAction()
    {
        $deleteId = $this->request->post('id');
        $res = Session::get('cart', $deleteId);
        Session::delete($res, $deleteId);
        header("Location: /cart/");
    }


}