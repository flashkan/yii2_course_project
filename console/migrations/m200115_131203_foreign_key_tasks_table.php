<?php

use yii\db\Migration;

/**
 * Class m200115_131203_foreign_key_tasks_table
 */
class m200115_131203_foreign_key_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('tasks_author_key', 'tasks', 'author', 'user', 'id');
        $this->addForeignKey('tasks_executor_key', 'tasks', 'executor', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('tasks_author_key', 'tasks');
        $this->dropForeignKey('tasks_executor_key', 'tasks');
    }

}
