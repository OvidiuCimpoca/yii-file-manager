<?php

namespace app\models;

class CreateTaskForm extends \yii\base\Model
{
    /*
     * */
    public $name;
    public $projectid;
    public $tasknr;
    public $description;
    public $createdby;
    public $developerid;
    public $status;
    public $priority;
    public $estimated;
    public $elapsed;
    public $createdat;
    public $updatedat;
    public $due;

    public function rules()
    {
        return [
            ['name','required'],
            ['tasknr','required'],
        ];
    }
}