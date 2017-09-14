<?php

/* @var $this yii\web\View */
/* @var $projectName app\models\Task */
/* @var $project app\models\Task */
/* @var $setTable app\models\Task */
/* @var $tasknr app\models\Task */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Task';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
        </div>

        <div class="row">
            <div class="col-lg-6">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'edit-task',
                ]);
                ?>
                <!--

    public $developerid;
    public $priority;
                -->
                <?= $form->field($model, 'name')->textInput(['value' => $task->name])->label('Task name:') ?>
                <?= $form->field($model, 'description')->textarea(['row' => '6', 'value' => HTML::encode($task['description']) ])->label('Description') ?>
                <?= $form->field($model, 'developerid')->dropDownList(
                    $users,
                    ['options' => [ $task->developerid => ['Selected' => 'selected' ]],
                        'prompt'=>'Select User', 'class' => '']
                )->label('Assigned to:') ?>
                <?= $form->field($model, 'priority')->dropDownList(
                    $priorities,
                    ['options' => [ $task->developerid => ['Selected' => 'selected' ]],
                        'prompt'=>'Select Priority', 'class' => '']
                )->label('Priority:') ?>

                <?= $form->field($model, 'status')->dropDownList(
                        $listStatus,
                        ['options' => [ $task->priority => ['Selected' => 'selected' ]],
                        'prompt'=>'Select Status', 'class' => '']
                )->label('Status:') ?>
                <?= $form->field($model, 'estimated')->textInput(['value' => $task->estimated])->label('Estimated(format: hh:mm:ss):') ?>
                <?= $form->field($model, 'elapsed')->textInput(['value' => $task->elapsed])->label('Elapsed(format: hh:mm:ss):') ?>
                <?php $date = new \DateTime($task->due);  ?>
                <div class="form-group field-edittaskform-due">
                    <?= HTML::label('Due:', ['for' => 'edittaskform-due'],['options' => ['class' => 'control-label']]) ?>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'edittaskform-due',
                        'name' => 'EditTaskForm[due]',
                        'value' => $date->format('Y-m-d'),
                        'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>
                </div>

                <div class="form-group">
                    <div class="col-lg offset-1 col-lg-6">
                        <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary'])?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>
