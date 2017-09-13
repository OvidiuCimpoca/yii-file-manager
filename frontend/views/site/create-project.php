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
                <?php
                $date = new \DateTime('now');
                ?>
                <?= $form->field($model, 'createdat')
                    ->hiddenInput(['value' => $date->format('Y-m-d')])
                    ->label(false) ?>
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
