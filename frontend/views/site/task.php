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
                        <div class="panel-heading"><?= HTML::encode($projectName) .'-' . HTML::encode($id) ?></div>
                        <div class="panel-body">
                            <input type="text" value="<?= HTML::encode($name) ?>" />
                            <textarea class="form-control" rows="3"><?= HTML::encode($description) ?></textarea>
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
                                <span>Assigned to: </span> <?= HTML::encode($developerid) ?> <a href="#">edit</a>
                            </div>
                            <div class="col-lg-12">
                                <span>Status: </span>
                                <select name="" id="">
                                    <?php
                                    foreach($statusList as $stat){
                                        ?>
                                        <option value="<?= $stat["id"]?>" <?= ($stat["id"] == $status)? 'selected': '' ?> ><?= $stat["name"]?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <span>estimated time: </span> <?= HTML::encode($estimated) ?> <a href="#">edit</a>
                            </div>
                            <div class="col-lg-12">
                                <span>time elapsed: </span> <?= HTML::encode($elapsed) ?> <a href="#">edit</a>
                            </div>
                            <div class="col-lg-12">
                                <span>created at: </span> <?= HTML::encode($createdat) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>closed at: </span> <?= HTML::encode($closedat) ?>
                            </div>
                            <div class="col-lg-12">
                                <span>Due date: </span> <?= HTML::encode($due) ?> <a href="#">edit</a>
                            </div>
                            <div class="col-lg-12">
                                <a href="#" class="btn btn-success">Save Changes</a>
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
