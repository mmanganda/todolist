<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskForm extends Model
{
    public $task;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task'], 'required'],         
        ];
    }
}
  
