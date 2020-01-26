<?php

namespace app\models;

use common\models\User;
use frontend\models\ChatLog;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int|null $author_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $author
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['author_id'], 'default', 'value' => Yii::$app->user->id]
        ];
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

    public function afterSave($insert, $changedAttribute)
    {
        if ($insert) {
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'type' => 2,
                'message' => 'has just created a project №' . $this->id,
                'project_id' => $this->id,
            ]);
        } else { // update
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'type' => 2,
                'message' => 'has just updated a project №' . $this->id,
                'project_id' => $this->id,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
    }

    public static function findProject($id) {
        return static::findOne($id);
    }

    public static function findAllTasks() {
        return Task::find()->where('project_id = 1')->all();
    }
}
