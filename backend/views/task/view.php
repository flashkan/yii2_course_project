<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'project_id',
                'format' => 'raw',

                'value' => function($data) {
                    $project = \app\models\Project::findProject($data->project_id);
                    return Html::a($project->name, ["../project/view?id=$project->id"]);
                }
            ],
            'description:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'status',
                'value' => function ($date) {
                    if ($date->status === 1) return 'Awaiting start';
                    elseif ($date->status === 2) return 'Run';
                    elseif ($date->status === 3) return 'Finished';
                }
            ],
            [
                'attribute' => 'author',
                'value' => function($date) {
                    return \common\models\User::findIdentity($date->author)->email;
                }
            ],
            [
                'attribute' => 'executor',
                'value' => function($date) {
                    return \common\models\User::findIdentity($date->executor)->email;
                }
            ],
        ],
    ]) ?>
    <?php
    /*    echo \kartik\datetime\DateTimePicker::widget([
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
        'format' => 'dd-MM-y H:i A',
        'startDate' => '01-Mar-2014 12:00 AM',
        'todayHighlight' => true
        ]
        ]);
    */ ?>
</div>
