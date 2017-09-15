<?php

/* @var $this yii\web\View */
/* @var $users */

use yii\helpers\Html;

$this->title = 'List Users';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Permission</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($users) > 10){
                    $start = 0;
                    $upperLimit = 10;
                    if(isset($page)){
                        $start = 10 * ($page -1);
                        if(sizeof($users) - $start < 10){
                            $upperLimit += sizeof($users) - $start;
                        }else{
                            $upperLimit = $start + 10;
                        }
                    }
                    for($i = $start; $i < $upperLimit; $i++){
                        $user = $users[$i];
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
                }else {
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
                }
                ?>
                </tbody>
            </table>
            <?php
            if(sizeof($users) > 10){
                $pageNr = intval(sizeof($users) / 10);
                if(sizeof($users) % 10){
                    $pageNr++;
                }
                $itt = 1;
                while($itt <= $pageNr){
                    if(isset($page)){
                        if($page != $itt){
                            echo HTML::a(HTML::encode($itt), ['list-users', 'page'=> $itt]);
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
                            echo HTML::a(HTML::encode($itt), ['list-users', 'page'=> $itt]);
                        }
                    }
                    $itt++;
                }
            }
            ?>
        </div>
        <div class="row">
            <?= HTML::a('New User', ['create-user'], ['class' => 'btn btn-lg btn-success'])?>
        </div>
    </div>
</div>
