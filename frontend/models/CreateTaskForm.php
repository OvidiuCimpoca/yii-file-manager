<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CreateTaskForm extends Model
{
    /*
     * */
    public $name;
    public $projectid;
    public $tasknr;
    public $description;
    public $createdby;
    public $developerid;
    public $priority;
    public $estimated;
    public $elapsed;
    public $createdat;
    public $updatedat;
    public $due;

    public function rules()
    {
        return [
            [['name', 'tasknr'], 'string', 'min' => 2, 'max' => 100]
            /*[['name', 'projectid', 'description'],'required'],
            ['createdby'],
            ['developerid'],
            ['status'],
            ['priority'],
            ['estimated'],
            ['elapsed'],
            ['createdat'],
            ['updatedat'],
            ['due'],*/
        ];
    }
}