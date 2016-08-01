<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItem;
use app\models\Product;
use Yii;

class CartController
    extends AController
{
    public function actionAdd($id, $count=1)
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $cart = new Cart();
        $cart->add($product, $count);
        $session = $cart->getSession();

        $this->layout = false;
        return $this->render('modal', compact('session'));

    }

    public function actionRemove($id)
    {
        $cart = new Cart();
        $cart->remove($id);
        $session=$cart->getSession();

        $this->layout = false;
        return $this->render('modal', compact('session'));
    }

    public function actionClear()
    {
        $cart = new Cart();
        $cart->clear();
        $this->layout = false;
        return $this->render('modal');
    }

    public function actionShow()
    {
        $cart = new Cart();

        $this->layout = false;
        return $this->render('modal', ['session' => $cart->getSession()]);

    }

    public function actionView()
    {
        $cart = new Cart();
        $order = new Order();
        $session = $cart->getSession();

        if ($order->load(Yii::$app->request->post())) {
            $order->count = $session['cart.count'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);

                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с Вами.');

                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom('server@mail.ru')
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Заказ')
                    ->send();

                $cart->clear();

                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Оши213123ия заказа');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    public function saveOrderItems($session, $order_id)
    {
        foreach ($session as $id => $item) {
            $orderItem = new OrderItem();
            $orderItem->fill($item, $id, $order_id);
            $orderItem->save();
        }

    }
}