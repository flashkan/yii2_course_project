<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $project = \app\models\Project::find()->where('id >= 1')->all();
    $resultProject = \yii\helpers\ArrayHelper::map($project,'id','name');
    ?>

    <?= $form->field($model, 'project_id')->dropDownList($resultProject) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'status')->radioList([
        1 => 'Awaiting start',
        2 => 'Run',
        3 => 'Finished',
    ]) ?>

    <!--    --><? //= $form->field($model, 'author')->textInput() ?>
    <?php
    $executors = \common\models\User::findAll([
        'status' => 10
    ]);
    $resultExecutors = \yii\helpers\ArrayHelper::map($executors,'id','email');
    ?>

    <?= $form->field($model, 'executor')->dropDownList($resultExecutors) ?>

    <?= $form->field($model, 'is_template')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
