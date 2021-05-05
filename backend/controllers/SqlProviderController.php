<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

class SqlProviderController extends Controller
{
    /* public function behaviours()
    {
        return [
            'verbs' => [
                'class' => VerbFilter:: className(),
                'actions' => [
                    'delete' => ['user'],
                ],
            ],
        ];
    } */


public function actionIndex()
{
$count = Yii::$app->db->createCommand('
    SELECT COUNT(*) FROM user'
    )->queryScalar();

    $sql = "SELECT * FROM user";

$sqlProvider = new SqlDataProvider([
    'sql' => $sql,
]);

print_r($sqlProvider);
return $this-> render('index',['sqlProvider' => $sqlProvider]);
}

}
?>