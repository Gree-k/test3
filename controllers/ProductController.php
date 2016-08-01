<?php

namespace app\controllers;

use app\models\Product;
use yii\web\HttpException;

class ProductController
    extends AController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            throw new HttpException(404, 'Такого товара не существует');
        }

        return $this->render('view', compact('product'));
    }

}