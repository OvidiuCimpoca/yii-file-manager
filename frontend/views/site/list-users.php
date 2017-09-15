<?php

/* @var $this yii\web\View */
/* @var $users */

use yii\helpers\Html;

$this->title = 'List Users';
?>
<div class="site-index">
    <div class="body-content">
        <table class="table">
            <thead>
            <th>Id</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Permission</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?= HTML::encode($user['id']) ?></td>
                    <td><?= HTML::encode($user['username']) ?></td>
                    <td><?= HTML::encode($user['email']) ?></td>
                    <td><?= HTML::encode($user['per_name']) ?></td>
                    <td><?= HTML::a('Edit', ['edit-user', 'id' => $user['id']], ['class' => 'btn btn-lg btn-success']) ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?= HTML::a('New User', ['create-user'], ['class' => 'btn btn-lg btn-success'])?>
    </div>
</div>
