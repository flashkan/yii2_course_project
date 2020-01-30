<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
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
                    return Html::a($data->name, ["view?id=$data->id"]);
                },
            ],
//            'description:ntext',
//            'created_at',
//            'updated_at',
            //'status',
            //'author',
            [
                'attribute' => 'executor',
                'value' => function ($date) {
                    return \common\models\User::findIdentity($date->executor)->email;
                }
            ],
            //'is_template',
            //'template_id',
            //'template_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
