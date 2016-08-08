<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 09.08.2016
 * Time: 0:18
 */

namespace app\models;


use yii\base\Model;

class TesForm extends Model
{

    public $name;
    public $email;


    public function rules()
    {
        return [
            [['name'], 'string'],
            ['email', 'email']
        ];
    }
}