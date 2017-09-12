<?php

namespace app\models;

use yii\base\Model;

class CreateProjectForm extends Model
{
    public $name;
    public $description;
    public $abbreviation;
    public $createdby;
    public $createdat;

    public function rules()
    {
        return [
            [['name', 'abbreviation'], 'required']
        ];
    }
}