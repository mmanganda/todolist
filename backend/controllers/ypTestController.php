<?php 

namespace app\controllers;
use Yii;

class TestController extends \yii\web\Controller
{
    public function actionHello()
    {
     //  Yii::$app->MyComponent->welcome();
       yii::$app->MyComponent->hello();
    }

}?>