<?php

namespace backend\components;
use yii\widgets\ActiveForm;
use yii\base\Component;
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
class MyUsersTasks extends Component{
    public $content;
	
    //  USERS DATA
  
    public function getUsers(){
$sql = "SELECT COUNT(task),email,username FROM mytasks GROUP BY email";


$sqlProvider = new SqlDataProvider([
            'sql' => $sql,
        ]);  
        
        
  //  DISPLAY DATA

?> 
 <?=GridView::widget([
        'dataProvider' => $sqlProvider,
        'columns' =>[
         //   'id',
            'email',
            'username',
            'COUNT(task)',
        ]
    ])?>
    <?php
    }
	
}
?>