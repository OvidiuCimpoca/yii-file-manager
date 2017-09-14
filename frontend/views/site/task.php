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
            <?= HTML::a($task["projectname"], ['project', 'id' => $task["projectid"]])?>
        </div>

        <div class="row">
            <div class="col-lg-9">

                <div class="panel panel-default">
                    <div class="panel-heading"><?= HTML::encode($task["name"]) ?></div>
                    <div class="panel-body">
                        <?= HTML::encode($task["description"]) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="row panel-body">
                        <div class="col-lg-12">
                            <span>Created by: </span> <?= HTML::encode($task['created_task']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Assigned to: </span> <?= HTML::encode($task['assigned_to']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Status: <?= HTML::encode($task['task_status_name']) ?></span>
                        </div>
                        <div class="col-lg-12">
                            <span>Priority: <?= HTML::encode($task['pr_name']) ?></span>
                        </div>
                        <div class="col-lg-12">
                            <span>Estimated time: </span> <?= HTML::encode($task['estimated']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Time elapsed: </span> <?= HTML::encode($task['elapsed']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Created at: </span> <?= HTML::encode($task['createdat']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Closed at: </span> <?= HTML::encode($task['closedat']) ?>
                        </div>
                        <div class="col-lg-12">
                            <span>Due date: </span> <?= HTML::encode($task['due']) ?>
                        </div>
                        <div class="col-lg-12">
                            <?php if($intelligenceMember){ ?>
                                <?= HTML::a('Update Task', ['update-task', 'id' => $task['id']], ['class' => 'btn btn-success']) ?>
                            <?php
                            }
                            if($editor) {
                            ?>
                                <?= HTML::a('Edit Task', ['edit-task', 'id' => $task['id']], ['class' => 'btn btn-success']) ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
