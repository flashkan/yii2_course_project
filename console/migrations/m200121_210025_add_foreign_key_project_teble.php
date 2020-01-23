<?php

use yii\db\Migration;

/**
 * Class m200121_210025_add_foreign_key_project_teble
 */
class m200121_210025_add_foreign_key_project_teble extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('project_author_id_key', 'project', 'author_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('project_author_id_key', 'project');
    }
}
