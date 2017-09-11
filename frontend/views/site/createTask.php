<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Form';

$form = ActiveForm::begin([
    'id' => 'create-task',
    'options' => ['class' => 'row'],
]) ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'tasknr') ?>
<div class="form-group">
    <div class="col-lg offset-1 col-lg-11">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
    </div>
</div>
<?php ActionForm::end() ?>

