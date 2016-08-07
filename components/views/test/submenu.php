<a class="menu<?php if(Yii::$app->controller->action->id == $item['key']) echo '-selected';?>"><?= $item['key']?></a><br/>
<?php if(!empty($item['children'])): ?>
    <div class="submenu">
        <?= $this->getSubMenu($item['children'])?>
    </div>
<?php endif;?>