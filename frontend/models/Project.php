<?php

namespace app\models;

use Yii;

class Project extends yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{project}}';
    }

    public static function getProjects()
    {
        $query = new yii\db\Query;
        $query->select('project.*, user.username')->from('project')->leftJoin('user', 'project.createdby = user.id');
        return $query;
    }
}