<?php

use yii\db\Migration;

/**
 * Class m200121_211611_add_foreign_key_tasks_table_to_project_table
 */
class m200121_211611_add_foreign_key_tasks_table_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('tasks_project_id_key', 'task', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('tasks_project_id_key', 'task');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200121_211611_add_foreign_key_tasks_table_to_project_table cannot be reverted.\n";

        return false;
    }
    */
}
