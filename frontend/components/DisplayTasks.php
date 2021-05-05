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

class DisplayTasks extends Component{
    public $content;


    //  SUBMIT TASK
function get_alltasks(){
    $sql = "SELECT * FROM mytasks WHERE email=$email";
    $sqlProvider = new SqlDataProvider([
        'sql' => $sql,
    ]);
    }
    
    function delete_task(){
        $id = $_GET['id'];
        $myCommand =  Yii::$app->db->createCommand()
                                   ->delete('mytasks','id='.$id);
        $myCommand->execute();
        get_alltasks();
    
    
         }
    
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
    //get_alltasks();
    //$sqlProvider.refresh();
    $sql = "SELECT * FROM mytasks";
    
    $sqlProvider = new SqlDataProvider([
        'sql' => $sql,
    ]);
    echo"updated";
    //header('Location:index.php');
    header("refresh: 1");
    }
     }
    
    
public function getTasks(){

$email = Yii::$app->user->identity->email;

$sql = "SELECT * FROM mytasks WHERE email='{$email}'";
    
$sqlProvider = new SqlDataProvider([
        'sql' => $sql,
    ]);
    
    
?>
<?=Html::beginForm('','post');?>

<?= GridView::widget([
        'dataProvider' => $sqlProvider,
        'columns' =>[
            ['class' => 'yii\grid\SerialColumn',
              'header'=>'No:' ,
            //  'label' =>'No:',
            ], // <-- here
            
            ['attribute' =>'id',
            'label' =>'id'],

            ['attribute' =>'email',
            'label' =>'email'],

            ['attribute' =>'username',
            'label' =>'username'],           
           // 'COUNT(task)',
           
           ['attribute' =>'task',
           'label' =>'task'],

           ['attribute' =>'date',
           'label' =>'date'],

           ['attribute' =>'status',
            'label' =>'status'],

           [
            'attribute' => 'update status',
            'label' =>'update status',
            'value' => function($model){
                  $id=$model['id'];
                  $myid=strval($id);
                  $name='updatestatus';
              //   return  Html::beginForm(['order/update', 'id' => $id], 'post', ['enctype' => 'multipart/form-data']) ;
                 return Html::dropDownList( $myid,'',[null=>'Select','open'=>'Open','doing'=>'Doing','done'=>'Done'],['name'=>'drop']);
               
                },
            'format' => 'raw',
           // 'filter'    => [ "open"=>"Open", "doing"=>"doing", "done"=>"done" ],
          /*   'value' => function ($data) {
                return $data->column_name;
            } */
        ],
          // 'status',
           [
            'class' => 'yii\grid\ActionColumn',
             'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    $url='index.php?statusupdate&id='.$model['id'].'&status='.$model['status'];
                    $row=array();
                   // $row[]=$key;
                   $id= $model['id'];
                   $myid=strval($id);

                   // $url=value-status;
                    // return $model->status === 'editable' ? Html::a('Update', $url) : '';
                    return Html::submitButton('submit',['class'=>'btn btn-success','name'=>'row['.$myid.']']);
                //  $url='index.php?update&id='.$model['id'].'&&status='.$model['status'];

                //  return $model? Html::a('update', $url) : '';

                 }, 
                 'delete' => function ($url, $model, $key) {
                    $url='index.php?delete&id='.$model['id'];
                    // return $model->status === 'editable' ? Html::a('Update', $url) : '';
                    return $model? Html::a('delete', $url) : '';
                 }, 
             
              ] 
            // you may configure additional properties here
        ],
        ]
    ]);


    ?>      
    <?=Html::endForm();?>
    
    <?php
    if(isset($_POST["row"])){
        $index = $_POST['row'];

$selected_row =  key($index);
echo $selected_row;
$myselected_row =strval($selected_row);
if(isset($_POST[$selected_row])){
    echo'hi';
    $status = $_POST[$selected_row];

echo 'row:'.$selected_row.'status:'.$status;
if($status){
update_status($selected_row,$status);
}
}
    }

if(isset($_GET["delete"])){
     $id = $_GET['id'];
     echo 'delete'.$id;
     delete_task();  
        }    ?>
<?php }} ?>

