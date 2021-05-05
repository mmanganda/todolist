<?php

namespace frontend\components;
use yii\widgets\ActiveForm;
use yii\base\Component;
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use app\controllers\addTaskForm; 

class SubmitTask extends Component{
    public $content;
//$model = addTaskForm::actionIndex(); 	
    //  SUBMIT TASK

public function addTask(){
?>
    <?php $form=ActiveForm::begin();?>
<?=$form->field($model,'task');?>
<?=Html::submitButton('submit',['class'=>'btn btn-success']);?>
<?php $form = ActiveForm::end();?>
<?php }} ?>
