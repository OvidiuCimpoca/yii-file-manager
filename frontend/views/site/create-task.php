<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CreateTaskForm */
/* @var $projectId */
/* @var $projects */
/* @var $users */
/* @var $priorities */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Task';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
            <?= HTML::a(HTML::encode($projects[$projectId]), ['project', 'id' => $projectId])?>
        </div>
        <div class="row">
            <div class="col-lg offset-1 col-lg-12">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'create-task',
                    'options' => ['class' => 'form-horizontal col-lg-4'],
                ]);
                ?>
                <?= $form->field($model, 'name')->label('Name:') ?>
                <?php
                echo $form->field($model,'projectid')->dropDownList(
                    $projects,
                    ['options' => [ $projectId => ['Selected' => 'selected' ]],
                    'prompt'=>'Select Project', 'class' => '']
                )->label('Project name:');
                ?>
                <?= $form->field($model, 'description')->textarea(['row' => '6'])->label('Description:') ?>
                <?= $form->field($model, 'createdby')
                    ->hiddenInput(['value' => Yii::$app->user->id])
                    ->label(false); ?>
                <?php
                echo $form->field($model,'developerid')->dropDownList(
                    $users,
                    ['prompt'=>'Select Developer', 'class' => '']
                )->label('Developer:');
                ?>
                <?php
                echo $form->field($model, 'priority')->dropDownList(
                        $priorities,
                        ['prompt' => 'Select Priority', 'class' => '']
                )->label('Priority:');
                ?>
                <?= $form->field($model, 'estimated')->label('Estimation (format hh:mm:ss):') ?>
                <?php $date = new \DateTime('now'); ?>
                <?= $form->field($model, 'createdat')
                    ->hiddenInput(['value' => $date->format('Y-m-d')])
                    ->label(false) ?>
                <div class="form-group field-createtaskform-due">
                    <?= HTML::label('Due at:', 'createtaskform-due', ['class' => 'control-label']) ?>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'createtaskform-due',
                        'name' => 'CreateTaskForm[due]',
                        'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <div class="col-lg offset-1 col-lg-6">
                        <?= Html::submitButton('Save Task', ['class' => 'btn btn-primary'])?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
