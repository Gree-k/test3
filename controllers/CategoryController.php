<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController
    extends AController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $category = Category::findOne($id);
        if (empty($category)) {
            throw new HttpException(404, 'Категория не существует');
        }

        $query=Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>9,
            'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view', compact('category', 'products', 'pages'));
    }
}