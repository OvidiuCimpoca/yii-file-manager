<?php

namespace app\models;

use yii\base\Model;

class EditProjectForm extends Model
{
    public $name;
    public $description;
    public $abbreviation;

    public function rules()
    {
        return [
            [['name', 'abbreviation'], 'required'],
        ];
    }
}