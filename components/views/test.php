<?php
$cont=Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<?php foreach ($tree as $item): ?>
    <?php $select=$cont == $item['key'];
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
<?php endforeach;?>
