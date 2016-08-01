<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cart
    extends ActiveRecord
{
    public $session;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->session = Yii::$app->session;
        $this->session->open();
    }

    public function getSession()
    {
        return $this->session;
    }

    public function add($product, $count)
    {
        if (!empty($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['count'] += $count;
        } else{
            $_SESSION['cart'][$product->id]=[
                'count' => $count,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        $_SESSION['cart.count']=empty($_SESSION['cart.count']) ? $count : $_SESSION['cart.count'] + $count;
        $_SESSION['cart.sum']=
            empty($_SESSION['cart.sum']) ? $count * $product->price : $_SESSION['cart.sum'] + $count * $product->price;
    }

    public function remove($id)
    {
        if (empty($_SESSION['cart'][$id])) {
            return;
        }
        $_SESSION['cart.count'] -= $_SESSION['cart'][$id]['count'];
        $_SESSION['cart.sum'] -= $_SESSION['cart'][$id]['count'] * $_SESSION['cart'][$id]['price'];
        unset($_SESSION['cart'][$id]);
    }

    public function clear()
    {
        $this->session->remove('cart');
        $this->session->remove('cart.count');
        $this->session->remove('cart.sum');
    }

}