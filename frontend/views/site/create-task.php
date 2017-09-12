<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CreateTaskForm */

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = 'Create Form';


?>

<div class="row">
    <div class="col-lg offset-1 col-lg-12">
        <?php
        $form = ActiveForm::begin([
            'id' => 'create-task',
            'options' => ['class' => 'form-horizontal col-lg-4'],
        ]); ?>
            <?= $form->field($model, 'name') ?>
            <?php
            $id = [];
            $value = [];
            foreach($projects as $project){
                $value[$project['id']] = $project['name'];
            }
            echo $form->field($model,'projectid')->dropDownList([
                    $value
            ],
            ['prompt'=>'Select Project']
            );
            ?>
            <?= $form->field($model, 'description') ?>
            <?= $form->field($model, 'createdby') ?>
            <?= $form->field($model, 'developerid') ?>
            <?= $form->field($model, 'priority') ?>
            <?= $form->field($model, 'estimated') ?>
            <?= $form->field($model, 'elapsed') ?>
            <?= $form->field($model, 'createdat') ?>
            <?= $form->field($model, 'updatedat') ?>
            <?= $form->field($model, 'due') ?>
            <div class="form-group">
                <div class="col-lg offset-1 col-lg-6">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

