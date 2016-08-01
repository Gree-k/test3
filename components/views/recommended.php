<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $count = count($hits);
            $i = 0; ?>
            <?php foreach($hits as $hit):?>
                <?php if(0 == $i % 3):?>
                    <div class="item <?= ($i==0)?'active':''?>">
                <?php endif; ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <?=Html::img("@web/images/products/$hit->img", ['alt'=>''])?>
                                <h2>$<?=$hit->price?></h2>
                                <p><?=Html::a($hit->name, ['product/view', 'id' => $hit->id], ['class'=>'text-muted'])?></p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
                <?php if(0 == $i % 3 || $count==$i):?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
        <?php if($count>3):?>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        <?php endif; ?>
    </div>
</div><!--/recommended_items-->
