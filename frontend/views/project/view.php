<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

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
            'name',
            'description:ntext',
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
                'value' => function ($date) {
                    return \common\models\User::findIdentity($date->author)->email;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->name, ["../task/view?id=$data->id"]);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($date) {
                    if ($date->status === 1) return 'Awaiting start';
                    elseif ($date->status === 2) return 'Run';
                    elseif ($date->status === 3) return 'Finished';
                }
            ],
            [
                'attribute' => 'executor',
                'value' => function($date) {
                    return \common\models\User::findIdentity($date->executor)->email;
                }
            ],
        ]
    ]) ?>


</div>
