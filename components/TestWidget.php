<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 07.08.2016
 * Time: 16:02
 */

namespace app\components;


use app\models\Page;
use yii\base\Widget;

class TestWidget extends Widget
{

    public $data;
    public $tree;
//    public $menu;

    public function run()
    {
        $this->data = Page::find()->indexBy('id')->asArray()->all();
        $tree = $this->getTree();

//        $menu = $this->getMenu($this->tree);
//        var_dump($this->tree);
        return $this->render('test', compact('tree'));
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenu($tree){
        $str = '';
        foreach ($tree as $item) {
            ob_start();
            include __DIR__ . '/views/test/menu.php';
            $str .= ob_get_clean();
        }
        return $str;
    }

    protected function getSubMenu($tree){
        $str = '';
        foreach ($tree as $item) {
            ob_start();
            include __DIR__ . '/views/test/submenu.php';
            $str .= ob_get_clean();
        }
        return $str;
    }
}