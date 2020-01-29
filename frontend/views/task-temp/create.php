<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskTemp */

$this->title = 'Create Task Temp';
$this->params['breadcrumbs'][] = ['label' => 'Task Temps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-temp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
