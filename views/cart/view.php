<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($session['cart'])): ?>
    <section id="cart_items">
        <div class="container">
            <div class=" cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($session['cart'] as $id => $item): ?>
                        <tr>
                            <td class="cart_product">
                                <?= Html::img("@web/images/{$item['image']}", ['alt' => $item['name'], 'height' => 50]) ?>
                            </td>
                            <td class="cart_description">
                                <h4><?= Html::a($item['name'], ['product/view', 'id' => $id]) ?></h4>
                            </td>
                            <td class="cart_price">
                                <p>$<?= $item['price'] ?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                           value="<?= $item['count'] ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$<?= $item['count'] * $item['price'] ?></p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete del-item" href="#" data-id="<?= $id ?>"><span
                                        class="fa fa-times"></span></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table table-condensed" style="border: solid rgb(221, 221, 221) 1px">
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-right">
                            <h4>Итого: </h4>
                        </td>
                        <td style="width: 10%">
                            <h4><?= $session['cart.count'] ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-right">
                            <h4>На сумму: </h4>
                        </td>
                        <td style="width: 10%">
                            <h4><?= $session['cart.sum'] ?></h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="margin-bottom: 20px" class="text-right">

<!--               Сделать поля имени/телефона/почты/адреса-->
                <?php $form = ActiveForm::begin() ?>
                <?= $form->field($order, 'user_id') ?>
                <?= Html::submitButton('Заказать', ['class' => 'btn btn-default get']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </section> <!--/#cart_items-->
<?php else: ?>
    <div class="container">
        <h2>Корзина пуста</h2>
    </div>
<?php endif; ?>