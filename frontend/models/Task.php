<?php

namespace app\models;

use Yii;

class Task extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{task}}';
    }
}
