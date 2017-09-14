<?php

/* @var $this yii\web\View */
/* @var $hasPermission app\models\Project */

use yii\helpers\Html;

$this->title = 'Project';
?>
<div class="site-index">

    <div class="body-content">

        <?php
        if(!empty($tasks)) {
            ?>

            <div class="row breadcrumb">
                <?= HTML::a('Projects', ['projects'])?>
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
                            <td><?= HTML::encode($task['id']) ?></td>
                            <td><?= HTML::encode($task['name']) ?></td>
                            <td><?= HTML::encode($task['description']) ?></td>
                            <td><?= HTML::encode($task['tsname']) ?></td>
                            <td><?= HTML::encode($task['pname']) ?></td>
                            <td><?= HTML::encode($task['dvname']) ?></td>
                            <td><?= HTML::encode($task['crname']) ?></td>
                            <td><?= HTML::encode($task['due']) ?></td>
                            <td><?= HTML::a('Go to', ['task', 'id' => $task['id']], ['class' => 'btn btn-lg btn-success'])?></td>
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
        <?= HTML::a('Add task', ['create-task', 'id' => $projectId], ['class' => 'btn btn-lg btn-success']) ?>
        <?= HTML::a('Edit project', ['edit-project', 'id' => $projectId], ['class' => 'btn btn-lg btn-success']) ?>
    </div>
</div>
