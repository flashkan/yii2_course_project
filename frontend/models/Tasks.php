<?php

namespace app\models;

use common\models\User;
use Yii;


/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string|null $name
 * @property int $auhtor
 * @property string $day
 *
 * @property User $id0
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'auhtor', 'day'], 'required'],
            [['id', 'auhtor'], 'integer'],
            [['day'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
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
            'auhtor' => 'Auhtor',
            'day' => 'Day',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
