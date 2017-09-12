<?php

/* @var $model app\models\CreateProjectForm */
/* @var $users app\models\CreateProjectForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title ='Create Project';

/*var_dump(Yii::$app->user->id);
die();*/
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
                    'id' => 'create-project',
                    'options' => ['class' => 'form-horizontal col-lg-4'],
                ]);
                ?>
                <?= $form->field($model, 'name')->label('Name:') ?>
                <?= $form->field($model, 'description')->textarea(['row' => '6'])->label('Description:') ?>
                <?= $form->field($model, 'abbreviation')->label('Abbreviation:') ?>

                <?= $form->field($model, 'createdby')
                    ->hiddenInput(['value' => Yii::$app->user->id])
                    ->label(false); ?>
                <div class="form-group field-createprojectform-createdat">
                    <label for="createprojectform-createdat" class="control-label">Created at:</label>
                    <?= yii\jui\DatePicker::widget([
                        'id' => 'createprojectform-createdat',
                        'name' => 'CreateProjectForm[createdat]',
                        'clientOptions' => ['defaultDate' => '2014-01-01'],
                        'value' => date('y-M-d'),
                        'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <div class="col-lg offset-1 col-lg-6">
                        <?= Html::submitButton('Save Project', ['class' => 'btn btn-primary'])?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
