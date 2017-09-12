<?php

namespace app\models;

use Yii;

class Project extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{project}}';
    }
}