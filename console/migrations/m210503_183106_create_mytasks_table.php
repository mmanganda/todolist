<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mytasks}}`.
 */
class m210503_183106_create_mytasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mytasks}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'task' => $this->text(),
            'username' => $this->string(),
            'date' => $this->string(),
            'status' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mytasks}}');
    }
}
