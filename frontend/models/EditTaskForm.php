<?php

namespace app\models;

use yii\base\Model;

class EditTaskForm extends Model
{
    public $name;
    public $description;
    public $developerid;
    public $status;
    public $priority;
    public $estimated;
    public $elapsed;
    public $due;

    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 2, 'max' => 100],
            [['name', 'developerid', 'priority', 'status', 'description'], 'required']
        ];
    }
}