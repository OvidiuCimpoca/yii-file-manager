<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'List Users';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row breadcrumb">
            <?= HTML::a('Users', ['list-users'])?>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'edit-user',
                ]);
                ?>
                <?= $form->field($model, 'username')->textInput(['value' => HTML::encode($user['username']) ])->label('Username:') ?>
                <?= $form->field($model, 'email')->textInput(['value' => HTML::encode($user['email']) ])->label('Email') ?>
                <?= $form->field($model, 'permission')->dropDownList(
                    $permissions,
                    ['options' => [ $user['permission'] => ['Selected' => 'selected' ]],
                        'prompt'=>'Select User Permission', 'class' => '']
                )->label('Permission:') ?>
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
