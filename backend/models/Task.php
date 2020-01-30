<?php

namespace app\models;

use common\models\User;
use frontend\controllers\TaskController;
use frontend\models\ChatLog;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * This is the model class for table "task".
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
class Task extends \yii\db\ActiveRecord implements Linkable
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function fields()
    {

        return array_merge(parent::fields(),[]);
    }

    public function extraFields()
    {
        return [
            'author',
            'authorEmail' => function () {
                return $this->author->email;
            },

        ];
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['task/view', 'id' => $this->id]),
            'authorEmailLink' => Url::to(['user/view', 'id'=>$this->author])
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

    public function beforeValidate()
    {
        if ($this->is_template) {
            $model = new TaskTemp();
            $model->attributes = $this->attributes;
            $model->save();
        }
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttribute)
    {
        if ($insert) {
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'type' => 2,
                'message' => 'has just created a task №' . $this->id,
                'task_id' => $this->id,
            ]);
        } else { // update
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'type' => 2,
                'message' => 'has just updated a task №' . $this->id,
                'task_id' => $this->id,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['project_id', 'name', 'status', 'executor'], 'required'],
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
