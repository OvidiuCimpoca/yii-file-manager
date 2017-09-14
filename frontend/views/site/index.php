<?php

/* @var $this yii\web\View */
/* @var $userStatus */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row jumbotron">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
                <h2>Project Management</h2>

                <?php if($userStatus != 0){ ?>
                    <p><?= HTML::a('Projects', ['projects'], ['class' => 'btn btn-lg btn-default']); ?></p>
                    <?php if($userStatus == 10){ ?>
                        <p><?= HTML::a('Users', ['list-users'], ['class' => 'btn btn-lg btn-default']); ?></p>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</div>
