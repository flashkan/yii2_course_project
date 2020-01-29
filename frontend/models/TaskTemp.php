<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_temp".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $executor
 */
class TaskTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            ['id', 'integer'],
            [['name', 'description', 'executor'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'executor' => 'Executor',
        ];
    }
}
