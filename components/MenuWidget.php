<?php
namespace app\components;

use app\models\Category;
use Yii;
use yii\base\Widget;

class MenuWidget
    extends Widget
{

    public $template;
    public $data;
    public $tree;
    public $html;

    public function init()
    {
        parent::init();
        if (null == $this->template) {
            $this->template = 'list';
        }
        $this->template .= '.php';
    }

    public function run()
    {
        $menu = Yii::$app->cache->get('menu');
        if ($menu) {
            return $menu;
        }

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->html = $this->getMenuHtml($this->tree);

        Yii::$app->cache->set('menu', $this->render('menu', ['template' => $this->html]), 60);
        return $this->render('menu', ['template' => $this->html]);
//        return $this->html;
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

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->toTemplate($category);
        }
        return $str;
    }

    protected function toTemplate($category){
        ob_start();
        include __DIR__ . '/views/menu/' . $this->template;
        return ob_get_clean();
    }


}