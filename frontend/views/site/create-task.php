<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CreateTaskForm */
/* @var $projects app\models\CreateTaskForm */
/* @var $users app\models\CreateTaskForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Form';


?>
<div class="site-index">

    <div class="body-content">
        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
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
                    ['prompt'=>'Select Project', 'class' => '']
                )->label('Project id:');
                ?>
                <?= $form->field($model, 'description')->label('Description:') ?>
                <?php
                echo $form->field($model,'createdby')->dropDownList(
                    $users,
                    ['prompt'=>'Select Project', 'class' => '']
                )->label('Created by:');
                echo $form->field($model,'developerid')->dropDownList(
                    $users,
                    ['prompt'=>'Select Project', 'class' => '']
                )->label('Developer:');
                ?>
                <?= $form->field($model, 'priority')->label('Priority:') ?>
                <?= $form->field($model, 'estimated')->label('Estimation (in minutes):') ?>
                <div class="form-group field-createtaskform-createdat">
                    <label for="createtaskform-createdat" class="control-label">Created at:</label>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'createtaskform-createdat',
                        'name' => 'CreateTaskForm[createdat]',
                        'clientOptions' => ['defaultDate' => '2014-01-01'],
                        'value' => date('y-M-d'),
                        'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-createtaskform-due">
                    <label for="createtaskform-due" class="control-label">Due at:</label>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'createtaskform-due',
                        'name' => 'CreateTaskForm[due]',
                        'clientOptions' => ['defaultDate' => '2014-01-01'],
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
