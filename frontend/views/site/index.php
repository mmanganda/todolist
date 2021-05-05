<?php
//use Yii;
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
//$this->title = 'My To-do List';
//echo $this->render( 'task', array( 'data' => $model ) );


//FORM MODEL///////////////////////////
?>
<?php $form=ActiveForm::begin();?>
<?=$form->field($model,'task');?>
<?=Html::submitButton('submit',['class'=>'btn btn-success']);?>
<?php $form = ActiveForm::end(); ?>

<?php
//////////////COMPONENTS///////////////////////
yii::$app->DisplayTasks->getTasks();   //DISPLAY GET TASK COMPONENT

//yii::$app->SubmitTask->addTask();   //DISPLAY GET TASK COMPONENT
//$url = Yii::$app->homeUrl;
//echo $url;
/////////////////////////////
  ?>