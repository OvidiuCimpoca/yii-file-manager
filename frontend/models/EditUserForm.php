<?php

namespace app\models;

use yii\base\Model;

class EditUserForm extends Model
{
    public $username;
    public $email;
    public $permission;

    public function rules()
    {
        return [
            [['username'], 'string', 'min' => 2, 'max' => 100],
            [['username', 'email', 'permission'], 'required']
        ];
    }
}