<?php

/* @var $this yii\web\View */
/* @var $hasPermission app\models\Project */
/* @var $taskMaker */
/* @var $projectId */
/* @var $editor */

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
            <div class="row">
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
                    if(sizeof($tasks) > 10){
                        $start = 0;
                        $upperLimit = 10;
                        if(isset($page)){
                            $start = 10 * ($page -1);
                            if(sizeof($tasks) - $start < 10){
                                $upperLimit += sizeof($tasks) - $start;
                            }else{
                                $upperLimit = $start + 10;
                            }
                        }
                        for($i = $start; $i < $upperLimit; $i++){
                            $task = $tasks[$i];
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
                            <?php
                        }
                    }else{
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
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if(sizeof($tasks) > 10){
                    $pageNr = intval(sizeof($tasks) / 10);
                    if(sizeof($tasks) % 10){
                        $pageNr++;
                    }
                    //var_dump($pageNr);
                    $itt = 1;
                    while($itt <= $pageNr){
                        if(isset($page)){
                            if($page != $itt){
                                echo HTML::a(HTML::encode($itt), ['project', 'id' => $projectId, 'page'=> $itt]);
                            } else {
                                ?>
                                <span><?= HTML::encode($itt) ?></span>
                                <?php
                            }
                        } else {
                            if($itt == 1){
                                ?>
                                <span>1</span>
                                <?php
                            } else {
                                echo HTML::a(HTML::encode($itt), ['project', 'id' => $projectId, 'page'=> $itt]);
                            }
                        }
                        $itt++;
                    }
                }
                ?>
            </div>
        <?php
        } else {
            ?><p>No tasks were found <?= HTML::a('go back', ['projects'])?> to projects list.</p><?php
        }
        ?>
        <div class="row">
            <?php if($taskMaker){ ?>
                <?= HTML::a('Add task', ['create-task', 'id' => $projectId], ['class' => 'btn btn-lg btn-success']) ?>
            <?php } ?>
            <?php if($editor){ ?>
                <?= HTML::a('Edit project', ['edit-project', 'id' => $projectId], ['class' => 'btn btn-lg btn-success']) ?>
            <?php } ?>
        </div>
    </div>
</div>
