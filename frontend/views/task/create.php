<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $template app\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $model->status = 1;
    if ($_GET['name'] && $_GET['description'] && $_GET['executor']) {
        $model->name = $_GET['name'];
        $model->description = $_GET['description'];
        $model->executor = $_GET['executor'];
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
        'template' => $template,
    ]) ?>

</div>
