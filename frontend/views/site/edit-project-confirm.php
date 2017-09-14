<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = "Edit Project";
?>
<div class="site-index">
    <div class="body-content">
        <div class="row breadcrumb">
            <?= HTML::a('Projects', ['projects'])?> /
        </div>
        <div class="row">
            <div class="col-lg offset-1 col-lg-11">
                Edited Project: <b><?= HTML::encode($name)?></b>
            </div>
        </div>
    </div>
</div>

