<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Projects List';
?>
<div class="site-index">

    <div class="body-content">

        <?php
        if($hasPermission == 1) {
            ?>
            <table class="table">
                <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Abbreviation</th>
                <th>Description</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>Finished at</th>
                <th></th>
                </thead>
                <tbody>
                <?php
                foreach ($projects as $project) {
                    ?>
                    <tr>
                        <td><?= HTML::encode($project->id) ?></td>
                        <td><?= HTML::encode($project->name) ?></td>
                        <td><?= HTML::encode($project->abbreviation) ?></td>
                        <td>
                            <?= HTML::encode($project->description) ?>
                        </td>
                        <td><?= HTML::encode($project->createdby) ?></td>
                        <td><?= HTML::encode($project->createdat) ?></td>
                        <td><?= HTML::encode($project->finishedat) ?></td>
                        <td><a class="btn btn-lg btn-success" href="<?= $goTo ?><?= HTML::encode($project->id) ?>">Go to</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <a class="btn btn-lg btn-success" href="#">Add Project</a>
            <?php
        } else {
            ?>
            <div class="col-lg-12">
                <h2>Don't have permission!</h2>
            </div>
            <?php
        }
        ?>

    </div>
</div>
