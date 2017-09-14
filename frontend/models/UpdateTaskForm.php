<?php

namespace app\models;

use yii\base\Model;

class UpdateTaskForm extends Model
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 2, 'max' => 100],
            [['name', 'description'], 'required']
        ];
    }
}