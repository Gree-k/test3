
<script src="//yandex.st/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready()
        .done(function (ym) {
            var myMap = new ym.Map('map', {
                center: [55.751574, 37.573856],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });

            jQuery.getJSON('/test/map', function (json) {
                /** Сохраним ссылку на геообъекты на случай, если понадобится какая-либо постобработка.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoQueryResult.xml
                 */
                var geoObjects = ym.geoQuery(json)
                    .addToMap(myMap)
                    .applyBoundsToMap(myMap, {
                        checkZoomRange: true
                    });
            });
        });
</script>



<div id="map" style="width: 100%; height: 500px;"></div>




<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($mod, 'name')->textInput()?>
<?= $form->field($mod, 'email')->input('email')?>

<?//= $form->field($model, 'name')->textInput()?>
<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => 'multiple']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>
<?php //$form = ActiveForm::begin() ?>
<?//= $form->field($mod, 'name')->textInput()?>
<!--<button>Submit</button>-->
<!---->
<?php //ActiveForm::end() ?>
