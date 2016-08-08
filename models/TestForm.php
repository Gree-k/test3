<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 08.08.2016
 * Time: 20:33
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class TestForm extends Model
{

    /**
     * @var UploadedFile[]
     */
    public $imageFiles=[];


    public function rules()
    {
        return [
            ['imageFiles', 'file', 'maxFiles' => 4],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
//            if (is_array($this->imageFiles)) {
            $fil = [];
                foreach ($this->imageFiles as $img) {
                    $str = 'images/' . $img->baseName . '.' . $img->extension;
                    $fil[]=$str;
                    $a=$img->saveAs($str);
//                    var_dump($img->b);

//                }
//            }else{
//                $this->imageFiles->saveAs('uploads/' . $this->imageFiles->baseName . '.' . $this->imageFiles->extension);
            }
            return $fil;
        } else {
            return false;
        }
    }


}