<?php

namespace frontend\components;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


class DisplayTasks extends Component{
    public $content;


  
//GET  TASKS   
public function getTasks(){

    $email = Yii::$app->user->identity->email;
    $sql = "SELECT * FROM mytasks WHERE email='{$email}'";        
    $sqlProvider = new SqlDataProvider([
            'sql' => $sql,
        ]);
    
//DISPLAY TASKS    
?>
<?=Html::beginForm('','post');?>
<?= GridView::widget([
        'dataProvider' => $sqlProvider,
        'columns' =>[
            ['class' => 'yii\grid\SerialColumn',
              'header'=>'No:' ,
            ],
            ['attribute' =>'date',
           'label' =>'DATE'],
            ['attribute' =>'id',
            'label' =>'ID'],

            ['attribute' =>'email',
            'label' =>'EMAIL'],

            ['attribute' =>'username',
            'label' =>'USERNAME'],           
           
           ['attribute' =>'task',
           'label' =>'TASK'],
           
           ['attribute' =>'status',
            'label' =>'STATUS'],

           [
            'attribute' => 'update status',
            'label' =>'CHANGE STATUS',
            'value' => function($model){
                  $id=$model['id'];
                  $myid=strval($id);
                  $name='updatestatus';
                 return Html::dropDownList( $myid,'',[null=>'Select','open'=>'Open','doing'=>'Doing','done'=>'Done'],['name'=>'drop']);
               
                },
            'format' => 'raw',
                ],
           [
            'class' => 'yii\grid\ActionColumn',
             'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    $url='index.php?statusupdate&id='.$model['id'].'&status='.$model['status'];
                    $row=array();
                   $id= $model['id'];
                   $myid=strval($id);

                   return Html::submitButton('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>',['class'=>'btn btn-success','name'=>'row['.$myid.']']);

                 }, 
                 'delete' => function ($url, $model, $key) {
                    $url='index.php?delete&id='.$model['id'];
                    return $model? Html::a('<span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>', $url) : '';
                 }, 
             
              ] 
        ],
        ]
    ]);

?>      
<?=Html::endForm();?>
    
<?php
//GET SELECTED ROW TO UPDATE
if(isset($_POST["row"])){
        $index = $_POST['row'];
$selected_row =  key($index);
//echo $selected_row;
$myselected_row =strval($selected_row);

if(isset($_POST[$selected_row])){
    $status = $_POST[$selected_row];

//echo 'row:'.$selected_row.'status:'.$status;
if($status){
update_status($selected_row,$status);
}
}
    }


if(isset($_GET["delete"])){
     $id = $_GET['id'];
    // echo 'delete'.$id;
     delete_task();  
        }    
 }}

#DELETE TASK
function delete_task(){
    $id = $_GET['id'];
    $myCommand =  Yii::$app->db->createCommand()
                               ->delete('mytasks','id='.$id);
    $myCommand->execute();
    get_alltasks();   
     }

#UPDATE TASK    
function update_status($selected_row,$status){
$id=$selected_row;
try{  
$myCommand =  Yii::$app->db->createCommand()
                           ->update('mytasks',['status'=>$status],'id='.$id);
$myCommand->execute();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
finally{
$sql = "SELECT * FROM mytasks";    
$sqlProvider = new SqlDataProvider([
    'sql' => $sql,
]);
   //REFRESH VIEW
    header("refresh: 1");
}
 }

//UPDATE VIEW TASKS
function get_alltasks(){
    try{
    $email = Yii::$app->user->identity->email;
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    finally{
    $sql = "SELECT * FROM mytasks WHERE email=$email";
    $sqlProvider = new SqlDataProvider([
        'sql' => $sql,
    ]);
   

    $relativeHomeUrl = Url::home();
    echo $relativeHomeUrl;
    echo Url::to($relativeHomeUrl);
    Yii::$app->response->redirect($relativeHomeUrl);

   // $controller=Yii::$app->getController();
 //   Yii::$app->response->redirect('/todolistapp/frontend/web/index.php?r=site%2Flogin');
  
    }
    }
?>

