<?php
namespace app\components;

use yii\base\Widget;

class PriceWidget
    extends Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        return $this->render('price');
    }

}