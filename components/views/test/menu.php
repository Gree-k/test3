<?php
$select=Yii::$app->controller->id == $item['key'];
$action = Yii::$app->controller->action->id;
?>
<li>
    <div class="menu-<?=$item['key']?><?php if($select) echo '-selected';?>">
        <p><?=$item['key']?></p>
        <?php if($select && !empty($item['children'])): ?>
            <div class="submenu">
                <?php foreach($item['children'] as $child):?>
                    <a class="menu<?php if($action == $child['key']) echo '-selected';?>"><?= $child['key']?></a><br/>
                <?php endforeach; ?>
            </div>
        <?php endif;?>
    </div>
</li>