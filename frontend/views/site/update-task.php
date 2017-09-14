<?php

/* @var $this yii\web\View */
/* @var $projectName app\models\Task */
/* @var $project app\models\Task */
/* @var $setTable app\models\Task */
/* @var $tasknr app\models\Task */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Task';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
        </div>

        <div class="row">
            <div class="col-lg-9">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'update-task',
                ]);
                ?>
                <?= $form->field($model, 'name')->textInput(['value' => HTML::encode($task['name'])])->label('Task name:') ?>
                <?= $form->field($model, 'description')->textarea(['row' => '6', 'value' => HTML::encode($task['description']) ])->label('Description') ?>
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
