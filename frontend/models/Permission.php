<?php

namespace app\models;

use Yii;

class Permission extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{permission}}';
    }
}
