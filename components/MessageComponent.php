<?php
namespace app\components;

use yii\base\Component;

class MessageComponent extends Component{
    public $content;
	
    public function message(){
   echo "WELCOME TO YII";
    }
	
   /*  public function display($content=null){
        if($content!=null){
            $this->content= $content;
        }
        echo Html::encode($this->content);
    } */
}
?>