<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m200121_205447_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->text(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
