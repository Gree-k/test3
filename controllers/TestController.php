<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 08.08.2016
 * Time: 20:33
 */

namespace app\controllers;

use app\models\TesForm;
use Yii;
use yii\web\UploadedFile;
use app\models\TestForm;
use yii\web\Controller;

class TestController extends AController
{
    public function actionMap()
    {

        $js = [ "type"=> "FeatureCollection"];


        $data = [];
            for ($i=0.02; $i<1;$i+=0.02){
                $data[]=[
                    "type" => "Feature",
                    "geometry" =>
                        [
                            "type" => "Point",
                            "coordinates" => [56.1 + $i, 37.1 + $i]
                        ],
                    "properties" =>
                        [
                            "balloonContent" => "Центр выдачи в Великом Новгороде Адрес: г.Великий Новгород, ул. Большая Санкт-Петербургская, д.39 стр 14, оф.1, СДЭК. Тел. (8162) 22-44-40 Заказ будет доставлен в пункт выдачи через 2-4 рабочих дня. Время работы: с понедельника по пятницу с 9-00 до 18-00.",
                            "hintContent" => "Центр выдачи в Великом Новгороде"
                        ],
                    "options" => [
//                        "preset" => "islands#violetDotIcon"
                        'iconLayout'=> 'default#image',
                        'iconImageHref' => '/web/images/loca.png',
//                        'iconImageSize' => [30, 32]
                    ]
                ];

            }

        $js["features"]=$data;
        return json_encode($js);




//        include __DIR__ . '/../web/data.json';
    }

    public function actionIndex()
    {
        $this->layout = false;

        $model = new TestForm();
        $mod = new TesForm();
        if (Yii::$app->request->isPost) {

            $mod->attributes = Yii::$app->request->post()['TesForm'];
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($a = $model->upload()) {
                echo '123123123123';
                // file is uploaded successfully
            }
//            var_dump($model->imageFiles);
//                var_dump(substr($model->imageFiles[0]->tempName,0, strpos($model->imageFiles[0]->tempName,'.'))
//                    . '.' . $model->imageFiles[0]->extension);
//            var_dump($model[0]->baseName);
//            die;
//            if($model->hasErrors()){
//                echo '123123123123123123123';
//            }
//            $mod->load(Yii::$app->request->post()['TesForm']);
//            var_dump(Yii::$app->request->post());
//            var_dump($model);
//            die;
//            $model->load(Yii::$app->request->post());
//            var_dump($_POST['TestForm']);
//            $model->name = $_POST['TestForm']['name'];

//            var_dump($model);
//            die();
//            $as = UploadedFile::getInstances($model, 'imageFiles');
//            var_dump($as);
//            $model->name = $_POST['name'];
            $mess = Yii::$app->mailer->compose()
                ->setFrom('lolkaenot@list.ru')
                ->setTo('lolkaenot@list.ru')
                ->setSubject($mod->name);

            foreach ($a as $img) {
                $mess->attach($img);

            }

            $mess->send();
            foreach ($a as $img) {
                unlink($img);

            }
        }


        return $this->render('index', compact('model', 'mod'));
    }
}