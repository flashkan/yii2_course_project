<?php

use yii\db\Migration;

/**
 * Class m200115_131203_foreign_key_task_table
 */
class m200115_131203_foreign_key_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('tasks_author_key', 'task', 'author', 'user', 'id');
        $this->addForeignKey('tasks_executor_key', 'task', 'executor', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('tasks_author_key', 'task');
        $this->dropForeignKey('tasks_executor_key', 'task');
    }

}
