<?php

/* @var $this yii\web\View */
/* @var $projects */
/* @var $editor */

use yii\helpers\Html;

$this->title = 'Projects List';
?>
<div class="site-index">
    <div class="body-content">
        <?php if(!empty($projects)){ ?>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Abbreviation</th>
                            <th>Description</th>
                            <th>Created by</th>
                            <th>Created at</th>
                            <th>Finished at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(sizeof($projects) > 10){
                        $start = 0;
                        $upperLimit = 10;
                        if(isset($page)){
                            $start = 10 * ($page -1);
                            if(sizeof($projects) - $start < 10){
                                $upperLimit += sizeof($projects) - $start;
                            }else{
                                $upperLimit = $start + 10;
                            }
                        }
                        for($i = $start; $i < $upperLimit; $i++){
                            $project = $projects[$i];
                            ?>
                            <tr>
                                <td><?= HTML::encode($project['id']) ?></td>
                                <td><?= HTML::encode($project['name']) ?></td>
                                <td><?= HTML::encode($project['abbreviation']) ?></td>
                                <td>
                                    <?= HTML::encode($project['description']) ?>
                                </td>
                                <td><?= HTML::encode($project['username']) ?></td>
                                <td><?= HTML::encode($project['createdat']) ?></td>
                                <td><?= HTML::encode($project['finishedat']) ?></td>
                                <td><?= HTML::a('Go to', ['project', 'id' => $project['id']], ['class' => 'btn btn-lg btn-success']) ?></td>
                            </tr>
                            <?php
                        }
                    }else {
                        foreach ($projects as $project) {
                            ?>
                            <tr>
                                <td><?= HTML::encode($project['id']) ?></td>
                                <td><?= HTML::encode($project['name']) ?></td>
                                <td><?= HTML::encode($project['abbreviation']) ?></td>
                                <td>
                                    <?= HTML::encode($project['description']) ?>
                                </td>
                                <td><?= HTML::encode($project['username']) ?></td>
                                <td><?= HTML::encode($project['createdat']) ?></td>
                                <td><?= HTML::encode($project['finishedat']) ?></td>
                                <td><?= HTML::a('Go to', ['project', 'id' => $project['id']], ['class' => 'btn btn-lg btn-success']) ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if(sizeof($projects) > 10){
                    $pageNr = intval(sizeof($projects) / 10);
                    if(sizeof($projects) % 10){
                        $pageNr++;
                    }
                    $itt = 1;
                    while($itt <= $pageNr){
                        if(isset($page)){
                            if($page != $itt){
                                echo HTML::a(HTML::encode($itt), ['projects', 'page'=> $itt]);
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
                                echo HTML::a(HTML::encode($itt), ['projects', 'page'=> $itt]);
                            }
                        }
                        $itt++;
                    }
                }
                ?>
            </div>
        <?php } ?>
        <div class="row">
            <?php if($editor){ ?>
                <?= HTML::a('New Project', ['create-project'], ['class' => 'btn btn-lg btn-success'])?>
            <?php } ?>
        </div>
    </div>
</div>
