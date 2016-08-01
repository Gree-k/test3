<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class IeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/html5shiv.js',
        'js/respond.min.js'
    ];
    public $jsOptions = [
        'condition' => 'lt IE 9',
        'position' => View::POS_HEAD,

    ];
}
