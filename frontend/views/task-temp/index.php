<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task Temps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-temp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task Temp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->name, ["../task/create",
                        'name' => $data->name,
                        'description' => $data->description,
                        'executor' => $data->executor]);
                },
            ],
            'description',
            [
                'attribute' => 'executor',
                'value' => function($date) {
                    return \common\models\User::findIdentity($date->executor)->email;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
