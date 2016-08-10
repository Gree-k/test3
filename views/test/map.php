
<script src="https://yastatic.net/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<?php
$js = [ "type"=> "FeatureCollection"];
$data=[] ;


for ($i=0; $i<10;$i++){
    $data[]=[
        "type" => "Feature",
        "geometry" =>
            [
                "type" => "Point",
                "coordinates" => [56.132465 , 37.1 . $i]
            ],
        "properties" =>
            [
                'id' => $i,
                "balloonContent" => "<div >$i Центр выдачи</div> в Великом Новгороде Адрес: г.Великий Новгород, ул. Большая Санкт-Петербургская, д.39 стр 14, оф.1, СДЭК. Тел. (8162) 22-44-40 Заказ будет доставлен в пункт выдачи через 2-4 рабочих дня. Время работы: с понедельника по пятницу с 9-00 до 18-00.",
                "hintContent" => "Центр выдачи в Великом Новгороде"
            ],
        "options" => [
//            'balloonOffset' =>  [100, -100]
//                        "preset" => "islands#violetDotIcon"
//            'iconLayout'=> 'default#image',
//            'iconImageHref' => '/web/images/loca.png',
//                        'iconImageSize' => [30, 32]
        ]
    ];

}

$js["features"]=$data;
$js = json_encode($js);
?>

<script type="text/javascript">

    var data=<?=$js?>

    ymaps.ready()
        .done(function (ym) {
            var myMap = new ym.Map('map', {
                center: [55.751574, 37.573856],
                zoom: 15
            }, {
                searchControlProvider: 'yandex#search'
            });


            ym.geoQuery(data)
                .addToMap(myMap)
                .applyBoundsToMap(myMap, {
                    checkZoomRange: true
                });
            $('.btn').on('click', function (e) {
                e.preventDefault();
//                ymaps.geoQuery(myMap.geoObjects).search('properties.id = "' + $(this).data('id') + '"')
////                    .getCentralObject(myMap).balloon.open();
////                    .setProperties('intersectBounds', true)
//                    .applyBoundsToMap(myMap).getCentralObject(myMap).balloon.open();
//                myMap.setZoom(17, {duration: 1000});
               var tes = ymaps.geoQuery(myMap.geoObjects).search('properties.id = "' + $(this).data('id') + '"');
                myMap.setCenter(tes.getCenter(myMap), 15);
                tes.getCentralObject(myMap).balloon.open();


//                myMap.getCentralObject(myMap).balloon.open();
//                alert(tes.getCenter(myMap));
//                myMap.setBounds(tes.getBounds());
//                alert(myMap.getCenter());
            });
        });


</script>



<div id="map" style="width: 100%; height: 500px;"></div>
<?php for($i=0; $i<10;$i++):?>
    <button data-id="<?=$i?>" class="btn btn-default">Search</button>
<?php endfor;?>
