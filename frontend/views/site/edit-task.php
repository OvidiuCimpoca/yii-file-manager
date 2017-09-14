<?php

/* @var $this yii\web\View */
/* @var $projectName app\models\Task */
/* @var $project app\models\Task */
/* @var $setTable */
/* @var $tasknr */
/* @var $model */
/* @var $task */
/* @var $users */
/* @var $projects */
/* @var $priorities */
/* @var $listStatus */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Task';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
            <?= HTML::a(HTML::encode($projects[$task->projectid]), ['project', 'id' => $task->projectid])?> /
            <?= HTML::a(HTML::encode($task->name), ['task', 'id' => $task->id])?>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'edit-task',
                ]);
                ?>
                <?= $form->field($model, 'name')->textInput(['value' => HTML::encode($task->name)])->label('Task name:') ?>
                <?= $form->field($model, 'description')->textarea(['row' => '6', 'value' => HTML::encode($task['description']) ])->label('Description') ?>
                <?= $form->field($model, 'developerid')->dropDownList(
                    $users,
                    ['options' => [ $task->developerid => ['Selected' => 'selected' ]],
                        'prompt'=>'Select User', 'class' => '']
                )->label('Assigned to:') ?>
                <?= $form->field($model, 'projectid')->dropDownList(
                    $projects,
                    ['options' => [ $task->projectid => ['Selected' => 'selected' ]],
                        'prompt'=>'Select Project', 'class' => '']
                )->label('Project:') ?>
                <?= $form->field($model, 'priority')->dropDownList(
                    $priorities,
                    ['options' => [ $task->priority => ['Selected' => 'selected' ]],
                        'prompt'=>'Select Priority', 'class' => '']
                )->label('Priority:') ?>
                <?= $form->field($model, 'status')->dropDownList(
                        $listStatus,
                        ['options' => [ $task->priority => ['Selected' => 'selected' ]],
                        'prompt'=>'Select Status', 'class' => '']
                )->label('Status:') ?>
                <?= $form->field($model, 'estimated')->textInput(['value' => HTML::encode($task->estimated)])->label('Estimated(format: hh:mm:ss):') ?>
                <?= $form->field($model, 'elapsed')->textInput(['value' => HTML::encode($task->elapsed)])->label('Elapsed(format: hh:mm:ss):') ?>
                <?php
                $date = NULL;
                if($task->due){
                    $dueDate = new \DateTime($task->due);
                    $date = $dueDate->format('Y-m-d');
                }
                ?>
                <div class="form-group field-edittaskform-due">
                    <?= HTML::label('Due:', ['for' => 'edittaskform-due'],['options' => ['class' => 'control-label']]) ?>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'edittaskform-due',
                        'name' => 'EditTaskForm[due]',
                        'value' => HTML::encode($date),
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
