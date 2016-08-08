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
    public function actionIndex()
    {
        $model = new TestForm();
        $mod = new TesForm();
        if (Yii::$app->request->isPost) {

            $mod->attributes=Yii::$app->request->post()['TesForm'];
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($a=$model->upload()) {
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
            $mess= Yii::$app->mailer->compose()
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