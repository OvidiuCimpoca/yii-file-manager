<?php

namespace app\models;

use yii\base\Model;

class CreateTaskForm extends Model
{
    /*
     * */
    public $name;
    public $projectid;
    public $description;
    public $createdby;
    public $developerid;
    public $priority;
    public $estimated;
    public $createdat;
    public $due;

    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 2, 'max' => 100],
            [['name', 'developerid', 'description'], 'required']
        ];
    }
}