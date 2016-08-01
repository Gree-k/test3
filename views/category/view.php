<?php
use app\components\BrandWidget;
use app\components\MenuWidget;
use app\components\PriceWidget;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <?= MenuWidget::widget() ?>
                    <?= BrandWidget::widget() ?>
                    <?= PriceWidget::widget() ?>

                    <div class="shipping text-center"><!--shipping-->
                        <?= Html::img('@web/images/home/shipping.jpg', ['alt'=> ''])?>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?= $category->name ?></h2>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="<?= Url::to(['product/view', 'id'=>$product->id])?>">
                                                <?= Html::img("@web/images/$product->image", ['alt' => $product->name]) ?>
                                            </a>
                                            <h2>$<?= $product->price ?></h2>
                                            <p><?= Html::a($product->name, ['product/view', 'id' => $product->id], ['class' => 'text-muted']) ?></p>
                                            <a href="#" data-id="<?=$product->id?>" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <?php if ($product->new): ?>
                                            <?= Html::img("@web/images/home/new.png", ['class' => 'new', 'alt' => '']) ?>
                                        <?php endif; ?>
                                        <?php if ($product->sale): ?>
                                            <?= Html::img("@web/images/home/sale.png", ['class' => 'new', 'alt' => '']) ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                            <h3>Товаров нет</h3>

                    <?php endif; ?>
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>