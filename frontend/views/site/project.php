<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Project';
?>
<div class="site-index">

    <div class="body-content">

        <?php
        if(!empty($tasks)) {
            ?>

            <div class="row breadcrumb">
                <a href="">Projects</a>
            </div>

            <table class="table">
                <thead>
                <th>nr</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned to</th>
                <th>Created by</th>
                <th>Due date</th>
                <th></th>
                </thead>
                <tbody>
                <?php

                if ($hasPermission) {
                    foreach ($tasks as $task) {
                        ?>
                        <tr>
                            <td><?= HTML::encode($task->id) ?></td>
                            <td><?= HTML::encode($task->name) ?></td>
                            <td><?= HTML::encode($task->description) ?></td>
                            <td><?= HTML::encode($task->status) ?></td>
                            <td><?= HTML::encode($task->priority) ?></td>
                            <td><?= HTML::encode($task->developerid) ?></td>
                            <td><?= HTML::encode($task->createdby) ?></td>
                            <td><?= HTML::encode($task->due) ?></td>
                            <td><a class="btn btn-lg btn-success" href="<?= $goTo ?><?= HTML::encode($task->id) ?>">Go to</a></td>
                        </tr>
                        <tr>

                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <?php
        }
        ?>

        <a class="btn btn-lg btn-success" href="#">Add task</a>

    </div>
</div>
