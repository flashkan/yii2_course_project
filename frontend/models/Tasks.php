<?php

namespace app\models;

use common\models\User;
use frontend\controllers\TaskController;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $status
 * @property int|null $author
 * @property int|null $executor
 * @property int|null $is_template
 *
 * @property User $author0
 * @property User $executor0
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ]
        ];
    }

    public function beforeValidate()
    {
        if ($this->is_template) {
            $model = new TaskTemp();
            $model->attributes = $this->attributes;
            $model->save();
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['project_id', 'created_at', 'updated_at', 'status', 'author', 'executor', 'is_template'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
            [['executor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['author'], 'default', 'value' => Yii::$app->user->id],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'author' => 'Author',
            'executor' => 'Executor',
            'is_template' => 'Is Template',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor0()
    {
        return $this->hasOne(User::className(), ['id' => 'executor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
