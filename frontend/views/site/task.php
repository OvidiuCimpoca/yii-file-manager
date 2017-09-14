<?php

/* @var $this yii\web\View */
/* @var $projectName app\models\Task */
/* @var $project app\models\Task */
/* @var $setTable app\models\Task */
/* @var $tasknr app\models\Task */

use yii\helpers\Html;

$this->title = 'Task';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
            <?= HTML::a($projectName, ['project', 'id' => $project])?>
        </div>

        <div class="row">
            <?php
            if($setTable == 1){
                ?>
                <div class="col-lg-9">

                    <div class="panel panel-default">
                        <div class="panel-heading"><?= HTML::encode($name) ?></div>
                        <div class="panel-body">
                            <?= HTML::encode($description) ?>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="row panel-body">
                            <div class="col-lg-12">
                                <span>Created by: </span> <?= HTML::encode($createdby) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Assigned to: </span> <?= HTML::encode($assigned_to) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Status: <?= HTML::encode($status) ?></span>
                            </div>
                            <div class="col-lg-12">
                                <span>Priority: <?= HTML::encode($priority) ?></span>
                            </div>
                            <div class="col-lg-12">
                                <span>Estimated time: </span> <?= HTML::encode($estimated) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Time elapsed: </span> <?= HTML::encode($elapsed) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Created at: </span> <?= HTML::encode($createdat) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Closed at: </span> <?= HTML::encode($closedat) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Due date: </span> <?= HTML::encode($due) ?>
                            </div>
                            <div class="col-lg-12">
                                <?= HTML::a('Update Task', ['update-task', 'id' => $id], ['class' => 'btn btn-success']) ?>
                                <?= HTML::a('Edit Task', ['edit-task', 'id' => $id], ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else{
                ?>
                <div class="col-lg-12">
                    <h2>No Task was found!</h2>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>
