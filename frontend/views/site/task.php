<?php 
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

?>
<?php echo"HI"?>
<?php $form=ActiveForm::begin();?>
<?=$form->field($model,'task');?>
<?=Html::submitButton('submit',['class'=>'btn btn-success']);?>
<?php $form = ActiveForm::end(); ?>
