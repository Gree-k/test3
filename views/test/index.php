<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($mod, 'name')->textInput()?>
<?= $form->field($mod, 'email')->input('email')?>

<?//= $form->field($model, 'name')->textInput()?>
<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => 'multiple']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>
<?php //$form = ActiveForm::begin() ?>
<?//= $form->field($mod, 'name')->textInput()?>
<!--<button>Submit</button>-->
<!---->
<?php //ActiveForm::end() ?>
